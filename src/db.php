<?php
/**
 * Ballonsport Krohmer — PDO-SQLite-Singleton
 *
 * Gibt die Datenbankverbindung zurück, initialisiert Schema und Seed beim ersten Aufruf.
 */
function db(): PDO
{
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    defined('ROOT') || define('ROOT', dirname(__DIR__));

    $dbPath = ROOT . '/data/krohmer.sqlite';

    $pdo = new PDO('sqlite:' . $dbPath, null, null, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

    $pdo->exec('PRAGMA journal_mode=WAL;');
    $pdo->exec('PRAGMA foreign_keys=ON;');

    // Schema-Migration (idempotent)
    require_once ROOT . '/src/schema.php';
    run_migrations($pdo);

    // Auto-Seed beim ersten Aufruf (wenn content-Tabelle leer)
    $count = (int) $pdo->query('SELECT COUNT(*) FROM content')->fetchColumn();
    if ($count === 0) {
        require_once ROOT . '/src/seed.php';
        run_seed($pdo);
    }

    return $pdo;
}
