<?php
/**
 * Ballonsport Krohmer — Bootstrap
 *
 * Definiert ROOT, lädt die Konfiguration, startet die Session
 * und bindet alle Helper ein.
 */

declare(strict_types=1);

// ---------------------------------------------------------------------------
// ROOT-Konstante (absoluter Pfad zum Projekt-Verzeichnis)
// ---------------------------------------------------------------------------
if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}

// ---------------------------------------------------------------------------
// Konfiguration laden
// ---------------------------------------------------------------------------
$cfgFile = ROOT . '/config/config.php';
if (!file_exists($cfgFile)) {
    $cfgFile = ROOT . '/config/config.example.php';
}

$CFG = require $cfgFile;

// ---------------------------------------------------------------------------
// Session starten (sichere Cookie-Settings)
// ---------------------------------------------------------------------------
if (session_status() === PHP_SESSION_NONE) {
    $sessionName = $CFG['session_name'] ?? 'krohmer_sess';

    session_name($sessionName);

    session_set_cookie_params([
        'lifetime' => 0,          // Session-Cookie (kein persistentes Cookie)
        'path'     => '/',
        'domain'   => '',
        'secure'   => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);

    session_start();
}

// ---------------------------------------------------------------------------
// Helper einbinden
// ---------------------------------------------------------------------------
require_once ROOT . '/src/helpers.php';
require_once ROOT . '/src/db.php';
require_once ROOT . '/src/content.php';
require_once ROOT . '/src/images.php';
require_once ROOT . '/src/auth.php';
require_once ROOT . '/src/seo.php';
require_once ROOT . '/src/migrations.php';

// DB-Verbindung herstellen (löst Migration + ggf. Seed aus)
db();

// ---------------------------------------------------------------------------
// Auto-Migrations: führt alle Dateien in /bin/migrations/ einmal aus.
// Status wird in der Tabelle `migrations` festgehalten.
// Bei Crash mitten in der Ausführung: nächste Request setzt fort.
// ---------------------------------------------------------------------------
try {
    apply_pending_migrations();
} catch (\Throwable $e) {
    error_log('apply_pending_migrations() failed: ' . $e->getMessage());
    // nicht abbrechen — die Site soll trotzdem laden
}

// ---------------------------------------------------------------------------
// Output-Buffering + ETag (nur GET, kein Admin, keine aktive Session-Cookie-
// Ausgabe in diesem Request)
// ---------------------------------------------------------------------------
if (
    ($_SERVER['REQUEST_METHOD'] ?? '') === 'GET'
    && !str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/admin')
    && !headers_sent()
) {
    ob_start(static function (string $buffer) {
        // ETag nur setzen wenn kein Set-Cookie-Header aktiv ist
        $headers = headers_list();
        $hasCookie = false;
        foreach ($headers as $h) {
            if (stripos($h, 'Set-Cookie:') === 0) {
                $hasCookie = true;
                break;
            }
        }
        if (!$hasCookie) {
            $etag = '"' . sha1($buffer) . '"';
            header('ETag: ' . $etag);
            $ifNoneMatch = $_SERVER['HTTP_IF_NONE_MATCH'] ?? '';
            if ($ifNoneMatch === $etag) {
                http_response_code(304);
                return '';
            }
        }
        return $buffer;
    });
}
