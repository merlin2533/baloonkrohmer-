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
 * Interner Cache für alle Image-Rows (wird beim ersten Zugriff befüllt).
 *
 * @return array<string, array{filename:string,alt:string}|null>
 */
function &_image_cache(): array
{
    static $cache = null;

    if ($cache === null) {
        $cache = [];
        $rows = db()->query('SELECT key, filename, alt FROM images')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $cache[$row['key']] = ['filename' => $row['filename'], 'alt' => $row['alt']];
        }
    }

    return $cache;
}

/**
 * Gibt die URL zum Bild zurück (inkl. ?v=filemtime für Cache-Busting).
 * Prüft, ob ein echter Upload im /uploads-Verzeichnis vorliegt.
 * Fällt auf Platzhalter-SVG zurück, wenn keine Datei gefunden wird.
 */
function img_url(string $key): string
{
    $cache = &_image_cache();
    $row   = $cache[$key] ?? null;

    if ($row === null) {
        return '/assets/img/placeholder-landscape.svg';
    }

    $filename = $row['filename'];

    // Bereits absoluter Pfad oder Asset-Referenz (Platzhalter, Logo etc.)
    if (str_starts_with($filename, 'assets/')) {
        $url     = '/' . $filename;
        $absPath = defined('ROOT') ? ROOT . '/public/' . $filename : '';
        if ($absPath !== '' && file_exists($absPath)) {
            $mtime = @filemtime($absPath);
            if ($mtime !== false) {
                $url .= '?v=' . $mtime;
            }
        }
        return $url;
    }

    // Upload-Datei: prüfen ob die Datei im uploads-Verzeichnis existiert
    $uploadPath = defined('ROOT') ? ROOT . '/public/uploads/' . $filename : '';
    if ($uploadPath !== '' && file_exists($uploadPath)) {
        $mtime = @filemtime($uploadPath);
        $url   = '/uploads/' . $filename;
        if ($mtime !== false) {
            $url .= '?v=' . $mtime;
        }
        return $url;
    }

    // Fallback: Platzhalter anhand des Keys wählen
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
 * Automatische Defaults:
 * - loading="lazy" (überschreibbar per $attrs)
 * - decoding="async" (überschreibbar per $attrs)
 * - width/height aus getimagesize() für Rasterbilder (verhindert CLS)
 *
 * Sonderattribut $attrs['priority'] => true: setzt fetchpriority="high"
 * und entfernt loading="lazy" (für LCP-Bilder).
 *
 * @param string   $key   Image-Key aus der DB
 * @param string   $alt   Überschreibt den gespeicherten Alt-Text (optional)
 * @param array    $attrs Weitere HTML-Attribute (width, height, class, priority, …)
 */
function img(string $key, string $alt = '', array $attrs = []): string
{
    $cache  = &_image_cache();
    $row    = $cache[$key] ?? null;

    $src    = img_url($key);
    $altVal = $alt !== '' ? $alt : ($row['alt'] ?? '');

    // Priority-Flag verarbeiten (LCP-Bilder)
    $priority = !empty($attrs['priority']);
    unset($attrs['priority']);

    // Standard-Attribute
    $defaults = [
        'src'      => $src,
        'alt'      => $altVal,
        'loading'  => $priority ? 'eager' : 'lazy',
        'decoding' => 'async',
    ];

    if ($priority) {
        $defaults['fetchpriority'] = 'high';
    }

    // width/height aus der Datei ermitteln (nur wenn nicht bereits übergeben)
    if (!isset($attrs['width']) && !isset($attrs['height'])) {
        // Pfad ohne Query-String
        $cleanSrc = strtok($src, '?');
        $absPath  = defined('ROOT') ? ROOT . '/public' . $cleanSrc : '';
        if (
            $absPath !== '' &&
            file_exists($absPath) &&
            !str_ends_with($absPath, '.svg')
        ) {
            $size = @getimagesize($absPath);
            if ($size !== false && $size[0] > 0 && $size[1] > 0) {
                $defaults['width']  = (string) $size[0];
                $defaults['height'] = (string) $size[1];
            }
        }
    }

    // Übergabe-Attribute überschreiben Defaults
    $merged = array_merge($defaults, $attrs);

    $attrStr = '';
    foreach ($merged as $name => $value) {
        $attrStr .= ' ' . e($name) . '="' . e((string) $value) . '"';
    }

    return '<img' . $attrStr . '>';
}

/**
 * Speichert oder aktualisiert einen Image-Key in der DB.
 * Invalidiert den In-Request-Cache für den betroffenen Key.
 */
function set_image(string $key, string $filename, string $alt = ''): void
{
    $stmt = db()->prepare(
        'INSERT INTO images (key, filename, alt, updated_at)
         VALUES (:key, :filename, :alt, :now)
         ON CONFLICT(key) DO UPDATE SET filename = :filename, alt = :alt, updated_at = :now'
    );
    $stmt->execute([':key' => $key, ':filename' => $filename, ':alt' => $alt, ':now' => time()]);

    // Cache aktualisieren
    $cache       = &_image_cache();
    $cache[$key] = ['filename' => $filename, 'alt' => $alt];
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
