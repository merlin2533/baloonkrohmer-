<?php
/**
 * Ballonsport Krohmer — Admin: Texte speichern (POST-Handler)
 */
declare(strict_types=1);

define('ROOT', dirname(__DIR__, 2));
require_once ROOT . '/src/bootstrap.php';

require_admin();

// Nur POST erlaubt
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Method Not Allowed');
}

// CSRF prüfen
if (!csrf_check($_POST['csrf_token'] ?? null)) {
    header('Location: /admin/content.php?error=' . urlencode('CSRF-Token ungültig. Bitte Seite neu laden.'));
    exit;
}

// Whitelist der erlaubten Keys
$allowedKeys = all_content_keys();
$allowedSet  = array_flip($allowedKeys);

// Section für Redirect ermitteln
$section = isset($_POST['_section']) ? (string) $_POST['_section'] : '';

// System-Felder, die wir überspringen
$systemFields = ['csrf_token', '_section'];

$saved = 0;
$errors = [];

foreach ($_POST as $key => $value) {
    $key = (string) $key;

    // System-Felder überspringen
    if (in_array($key, $systemFields, true)) {
        continue;
    }

    // Whitelist prüfen
    if (!isset($allowedSet[$key])) {
        // Unbekannter Key — ignorieren (keine Fehlermeldung nötig, da sicher)
        continue;
    }

    try {
        set_content($key, (string) $value);
        $saved++;
    } catch (Exception $e) {
        $errors[] = $key;
    }
}

if (!empty($errors)) {
    $errorMsg = 'Einige Felder konnten nicht gespeichert werden: ' . implode(', ', $errors);
    $redirect = '/admin/content.php?error=' . urlencode($errorMsg);
    if ($section !== '') {
        $redirect .= '#section-' . urlencode($section);
    }
    header('Location: ' . $redirect);
    exit;
}

$redirect = '/admin/content.php?saved=1';
if ($section !== '') {
    $redirect .= '&section=' . urlencode($section);
    $redirect .= '#section-' . urlencode($section);
}
header('Location: ' . $redirect);
exit;
