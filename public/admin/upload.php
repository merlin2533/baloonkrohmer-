<?php
/**
 * Ballonsport Krohmer — Admin: Bild-Upload-Handler (POST only)
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
    header('Location: /admin/images.php?error=' . urlencode('CSRF-Token ungültig. Bitte Seite neu laden.'));
    exit;
}

// Key aus POST holen und gegen Whitelist prüfen
$key = isset($_POST['key']) ? (string) $_POST['key'] : '';

if ($key === '') {
    header('Location: /admin/images.php?error=' . urlencode('Kein Bild-Key angegeben.'));
    exit;
}

$allowedKeys = all_image_keys();
if (!in_array($key, $allowedKeys, true)) {
    header('Location: /admin/images.php?error=' . urlencode('Ungültiger Bild-Key.'));
    exit;
}

// Upload-Datei prüfen
if (!isset($_FILES['image'])) {
    header('Location: /admin/images.php?error=' . urlencode('Keine Datei übermittelt.'));
    exit;
}

$file = $_FILES['image'];

// Upload-Fehler prüfen
if ($file['error'] !== UPLOAD_ERR_OK) {
    $uploadErrors = [
        UPLOAD_ERR_INI_SIZE   => 'Datei überschreitet die maximale Upload-Größe (php.ini).',
        UPLOAD_ERR_FORM_SIZE  => 'Datei überschreitet die maximale Formulargröße.',
        UPLOAD_ERR_PARTIAL    => 'Datei wurde nur teilweise hochgeladen.',
        UPLOAD_ERR_NO_FILE    => 'Keine Datei hochgeladen.',
        UPLOAD_ERR_NO_TMP_DIR => 'Kein temporäres Verzeichnis verfügbar.',
        UPLOAD_ERR_CANT_WRITE => 'Datei konnte nicht gespeichert werden.',
        UPLOAD_ERR_EXTENSION  => 'Upload durch PHP-Extension abgebrochen.',
    ];
    $msg = $uploadErrors[$file['error']] ?? 'Unbekannter Upload-Fehler (' . $file['error'] . ').';
    header('Location: /admin/images.php?error=' . urlencode($msg));
    exit;
}

// Dateigröße prüfen (max 5 MB)
$maxSize = 5 * 1024 * 1024;
if ($file['size'] > $maxSize) {
    header('Location: /admin/images.php?error=' . urlencode('Datei zu groß (max. 5 MB).'));
    exit;
}

// MIME-Type via finfo prüfen (nicht nur Extension!)
$allowedMimes = [
    'image/jpeg' => 'jpg',
    'image/png'  => 'png',
    'image/webp' => 'webp',
];

$finfo    = new finfo(FILEINFO_MIME_TYPE);
$mimeType = $finfo->file($file['tmp_name']);

if (!isset($allowedMimes[$mimeType])) {
    header('Location: /admin/images.php?error=' . urlencode(
        'Ungültiger Dateityp "' . $mimeType . '". Erlaubt: JPEG, PNG, WebP.'
    ));
    exit;
}

$ext = $allowedMimes[$mimeType];

// Zieldateiname: <key>-<8-stelliger hex-Hash>.<ext>
$hash     = bin2hex(random_bytes(4));
$filename = $key . '-' . $hash . '.' . $ext;
$destDir  = ROOT . '/public/uploads/';
$destPath = $destDir . $filename;

// Zielverzeichnis prüfen
if (!is_dir($destDir) || !is_writable($destDir)) {
    header('Location: /admin/images.php?error=' . urlencode('Upload-Verzeichnis nicht beschreibbar.'));
    exit;
}

// Datei verschieben
if (!move_uploaded_file($file['tmp_name'], $destPath)) {
    header('Location: /admin/images.php?error=' . urlencode('Datei konnte nicht gespeichert werden.'));
    exit;
}

// Alt-Text aus POST
$altText = isset($_POST['alt']) ? trim((string) $_POST['alt']) : '';

// DB aktualisieren — ALTEN Eintrag NICHT löschen (Sicherheit / Cache-Busting)
// Nur neuen Dateinamen (ohne Pfad-Prefix, img_url baut /uploads/ davor) speichern
set_image($key, $filename, $altText);

header('Location: /admin/images.php?uploaded=' . urlencode($key));
exit;
