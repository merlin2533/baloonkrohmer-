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

// DB-Verbindung herstellen (löst Migration + ggf. Seed aus)
db();
