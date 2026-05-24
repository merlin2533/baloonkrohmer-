<?php
/**
 * Ballonsport Krohmer — Auto-Migration-System
 *
 * Jede Datei in /bin/migrations/ ist eine Einmal-Migration. Sortiert nach
 * Dateiname (Konvention: YYYY_MM_DD_NNN_kurzname.php). Jede Migration läuft
 * genau einmal — der Status wird in der Tabelle `migrations` gespeichert.
 *
 * Aufruf erfolgt automatisch durch src/bootstrap.php nach DB-Init.
 *
 * Migrations dürfen das volle Helper-Set verwenden (t, set_content, set_image …)
 * und sollten idempotent sein, falls ein Crash mitten in der Ausführung
 * passiert.
 */

function apply_pending_migrations(): array
{
    $pdo = db();

    // Migrations-Tracking-Tabelle anlegen
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS migrations (
            id          TEXT PRIMARY KEY,
            applied_at  INTEGER NOT NULL
        )'
    );

    // Bereits angewendete Migrations laden
    $appliedRows = $pdo->query('SELECT id FROM migrations')->fetchAll(PDO::FETCH_COLUMN);
    $applied     = array_flip($appliedRows);

    // Alle Migrations-Dateien einsammeln und sortieren
    if (!defined('ROOT')) {
        return [];
    }
    $migDir = ROOT . '/bin/migrations';
    if (!is_dir($migDir)) {
        return [];
    }
    $files = glob($migDir . '/*.php');
    if ($files === false || $files === []) {
        return [];
    }
    sort($files);

    // Datei-Lock, damit nicht zwei parallele Requests dieselbe Migration starten
    $lockFile = ROOT . '/data/.migration.lock';
    $lock     = @fopen($lockFile, 'c');
    if ($lock === false || !flock($lock, LOCK_EX | LOCK_NB)) {
        // Anderer Prozess arbeitet gerade — überspringen, beim nächsten Request neu versuchen
        if ($lock !== false) { fclose($lock); }
        return [];
    }

    // Status nach Lock-Erwerb noch einmal frisch laden
    $appliedRows = $pdo->query('SELECT id FROM migrations')->fetchAll(PDO::FETCH_COLUMN);
    $applied     = array_flip($appliedRows);

    $ran = [];
    foreach ($files as $file) {
        $id = basename($file, '.php');
        if (isset($applied[$id])) {
            continue;
        }
        try {
            include $file;
            $pdo->prepare('INSERT OR IGNORE INTO migrations (id, applied_at) VALUES (?, ?)')
                ->execute([$id, time()]);
            $ran[] = $id;
        } catch (\Throwable $e) {
            error_log("Migration {$id} failed: " . $e->getMessage());
            break;  // bei Fehler abbrechen — beim nächsten Request weiter
        }
    }

    flock($lock, LOCK_UN);
    fclose($lock);

    return $ran;
}

/**
 * Liefert alle angewendeten Migrations + ihre Zeitpunkte.
 * Für die Admin-UI.
 */
function list_applied_migrations(): array
{
    $pdo = db();
    $pdo->exec('CREATE TABLE IF NOT EXISTS migrations (id TEXT PRIMARY KEY, applied_at INTEGER NOT NULL)');
    return $pdo->query('SELECT id, applied_at FROM migrations ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Liefert alle verfügbaren Migration-Dateien (sortiert).
 */
function list_available_migrations(): array
{
    if (!defined('ROOT')) {
        return [];
    }
    $files = glob(ROOT . '/bin/migrations/*.php');
    if ($files === false) {
        return [];
    }
    sort($files);
    return array_map(fn($f) => basename($f, '.php'), $files);
}
