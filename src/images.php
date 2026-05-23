<?php
/**
 * Ballonsport Krohmer — Image-Helper
 *
 * img()          — gibt vollständiges <img>-Tag zurück
 * img_url()      — gibt die URL zum Bild zurück (Upload oder Platzhalter)
 * set_image()    — speichert/aktualisiert einen Image-Key
 * all_image_keys() — alle vorhandenen Keys
 */

/**
 * Gibt die URL zum Bild zurück.
 * Prüft, ob ein echter Upload im /uploads-Verzeichnis vorliegt.
 * Fällt auf Platzhalter-SVG zurück, wenn keine Datei gefunden wird.
 */
function img_url(string $key): string
{
    static $cache = [];

    if (!isset($cache[$key])) {
        $stmt = db()->prepare('SELECT filename, alt FROM images WHERE key = :key');
        $stmt->execute([':key' => $key]);
        $row = $stmt->fetch();
        $cache[$key] = $row ?: null;
    }

    if ($cache[$key] === null) {
        return '/assets/img/placeholder-landscape.svg';
    }

    $filename = $cache[$key]['filename'];

    // Bereits absoluter Pfad oder Asset-Referenz (Platzhalter, Logo etc.)
    if (str_starts_with($filename, 'assets/')) {
        return '/' . $filename;
    }

    // Upload-Datei: prüfen ob die Datei im uploads-Verzeichnis existiert
    $uploadPath = defined('ROOT') ? ROOT . '/public/uploads/' . $filename : '';
    if ($uploadPath !== '' && file_exists($uploadPath)) {
        return '/uploads/' . $filename;
    }

    // Fallback: Platzhalter anhand des Dateinamens wählen
    if (str_contains($key, 'hero')) {
        return '/assets/img/placeholder-hero.svg';
    }
    if (str_contains($key, 'portrait') || str_contains($key, 'ballon_d')) {
        return '/assets/img/placeholder-portrait.svg';
    }

    return '/assets/img/placeholder-landscape.svg';
}

/**
 * Gibt ein vollständiges <img>-Tag zurück.
 *
 * @param string   $key   Image-Key aus der DB
 * @param string   $alt   Überschreibt den gespeicherten Alt-Text (optional)
 * @param array    $attrs Weitere HTML-Attribute (width, height, class, …)
 */
function img(string $key, string $alt = '', array $attrs = []): string
{
    static $cache = [];

    if (!isset($cache[$key])) {
        $stmt = db()->prepare('SELECT filename, alt FROM images WHERE key = :key');
        $stmt->execute([':key' => $key]);
        $row = $stmt->fetch();
        $cache[$key] = $row ?: null;
    }

    $src    = img_url($key);
    $altVal = $alt !== '' ? $alt : ($cache[$key]['alt'] ?? '');

    // Standard-Attribute
    $defaults = [
        'src'     => $src,
        'alt'     => $altVal,
        'loading' => 'lazy',
    ];

    // Übergabe-Attribute überschreiben Defaults (außer src/alt/loading nur wenn explizit gesetzt)
    $merged = array_merge($defaults, $attrs);

    $attrStr = '';
    foreach ($merged as $name => $value) {
        $attrStr .= ' ' . e($name) . '="' . e((string) $value) . '"';
    }

    return '<img' . $attrStr . '>';
}

/**
 * Speichert oder aktualisiert einen Image-Key in der DB.
 */
function set_image(string $key, string $filename, string $alt = ''): void
{
    $stmt = db()->prepare(
        'INSERT INTO images (key, filename, alt, updated_at)
         VALUES (:key, :filename, :alt, :now)
         ON CONFLICT(key) DO UPDATE SET filename = :filename, alt = :alt, updated_at = :now'
    );
    $stmt->execute([':key' => $key, ':filename' => $filename, ':alt' => $alt, ':now' => time()]);
}

/**
 * Gibt alle vorhandenen Image-Keys zurück.
 *
 * @return string[]
 */
function all_image_keys(): array
{
    $stmt = db()->query('SELECT key FROM images ORDER BY key');
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
