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
 *
 * Optionaler zweiter Parameter $variant (z.B. 480, 960, 1600) gibt die
 * URL zur entsprechenden Breitenvariante zurück – falls diese existiert.
 * Fällt auf das Original zurück, wenn die Variante nicht vorhanden ist.
 */
function img_url(string $key, int $variant = 0): string
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

    // Upload-Datei: Variante anfordern?
    if ($variant > 0 && defined('ROOT')) {
        $basename  = pathinfo($filename, PATHINFO_FILENAME);
        $varFile   = $basename . '-' . $variant . '.jpg';
        $varPath   = ROOT . '/public/uploads/' . $varFile;
        if (file_exists($varPath)) {
            $mtime = @filemtime($varPath);
            $url   = '/uploads/' . $varFile;
            if ($mtime !== false) {
                $url .= '?v=' . $mtime;
            }
            return $url;
        }
        // Variante nicht vorhanden → Fallback auf Original (weiter unten)
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
 * Interne Hilfsfunktion: Prüft ob WebP-Varianten für einen Upload-Dateinamen existieren.
 * Gibt das Basisverzeichnis und den Dateinamen-Basename zurück, oder null wenn keine Varianten.
 *
 * Prüft 480, 960 und 1600 — mindestens eine muss vorhanden sein.
 *
 * @return array{uploadDir:string,basename:string}|null
 */
function _img_variants_info(string $filename): ?array
{
    if (!defined('ROOT')) {
        return null;
    }
    // Nur für echte JPG-Uploads (nicht SVG, nicht assets/-Pfade)
    if (str_starts_with($filename, 'assets/') || str_ends_with($filename, '.svg')) {
        return null;
    }
    $basename  = pathinfo($filename, PATHINFO_FILENAME);
    $uploadDir = ROOT . '/public/uploads';
    // Prüfen ob mindestens eine Breiten-WebP-Variante existiert
    foreach ([480, 960, 1600] as $w) {
        if (file_exists($uploadDir . '/' . $basename . '-' . $w . '.webp')) {
            return ['uploadDir' => $uploadDir, 'basename' => $basename];
        }
    }
    return null;
}

/**
 * Interne Hilfsfunktion: Baut einen srcset-String für eine Breitenliste.
 * Überspringt Breiten, für die keine Datei existiert.
 */
function _img_srcset(string $uploadDir, string $basename, string $ext, string $urlPrefix = '/uploads/'): string
{
    $parts = [];
    foreach ([480, 960, 1600] as $w) {
        $file = $basename . '-' . $w . '.' . $ext;
        if (!file_exists($uploadDir . '/' . $file)) {
            continue;
        }
        $mtime = @filemtime($uploadDir . '/' . $file);
        $url   = $urlPrefix . $file . ($mtime !== false ? '?v=' . $mtime : '');
        $parts[] = $url . ' ' . $w . 'w';
    }
    return implode(', ', $parts);
}

/**
 * Gibt ein vollständiges <img>-Tag zurück, oder — wenn Varianten existieren —
 * ein vollständiges <picture>-Element mit WebP + JPEG srcsets.
 *
 * Automatische Defaults:
 * - loading="lazy" (überschreibbar per $attrs)
 * - decoding="async" (überschreibbar per $attrs)
 * - width/height aus getimagesize() für Rasterbilder (verhindert CLS)
 *
 * Sonderattribute in $attrs:
 *   priority (bool)  → fetchpriority="high", loading="eager" (für LCP)
 *   sizes   (string) → überschreibt den Default-sizes-String in <source>
 *
 * @param string   $key   Image-Key aus der DB
 * @param string   $alt   Überschreibt den gespeicherten Alt-Text (optional)
 * @param array    $attrs Weitere HTML-Attribute (width, height, class, priority, sizes, …)
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

    // Sizes-Attribut (für srcset-Nutzung)
    $sizesVal = $attrs['sizes'] ?? '(max-width: 640px) 100vw, (max-width: 1100px) 80vw, 1200px';
    unset($attrs['sizes']);

    // CSS-Klasse für <picture>-Wrapper speichern, dann aus img-attrs entfernen
    $pictureClass = $attrs['picture_class'] ?? '';
    unset($attrs['picture_class']);

    // Prüfen ob Varianten vorhanden sind
    $filename     = $row['filename'] ?? '';
    $variantsInfo = _img_variants_info($filename);

    // width/height aus Original ermitteln (verhindert CLS)
    $imgWidth  = null;
    $imgHeight = null;
    if (!isset($attrs['width']) && !isset($attrs['height'])) {
        $cleanSrc = strtok($src, '?');
        $absPath  = defined('ROOT') ? ROOT . '/public' . $cleanSrc : '';
        if (
            $absPath !== '' &&
            file_exists($absPath) &&
            !str_ends_with($absPath, '.svg')
        ) {
            $size = @getimagesize($absPath);
            if ($size !== false && $size[0] > 0 && $size[1] > 0) {
                $imgWidth  = (string) $size[0];
                $imgHeight = (string) $size[1];
            }
        }
    } else {
        $imgWidth  = isset($attrs['width'])  ? (string) $attrs['width']  : null;
        $imgHeight = isset($attrs['height']) ? (string) $attrs['height'] : null;
        unset($attrs['width'], $attrs['height']);
    }

    // -----------------------------------------------------------------------
    // <picture> mit srcset wenn Varianten vorhanden
    // -----------------------------------------------------------------------
    if ($variantsInfo !== null) {
        $uploadDir = $variantsInfo['uploadDir'];
        $basename  = $variantsInfo['basename'];

        $webpSrcset = _img_srcset($uploadDir, $basename, 'webp');
        $jpegSrcset = _img_srcset($uploadDir, $basename, 'jpg');

        // Fallback-<img>-Attribute
        $imgAttrs = array_merge([
            'src'      => $src,
            'alt'      => $altVal,
            'loading'  => $priority ? 'eager' : 'lazy',
            'decoding' => 'async',
        ], $attrs);

        if ($priority) {
            $imgAttrs['fetchpriority'] = 'high';
        }
        if ($imgWidth !== null) {
            $imgAttrs['width'] = $imgWidth;
        }
        if ($imgHeight !== null) {
            $imgAttrs['height'] = $imgHeight;
        }

        $imgAttrStr = '';
        foreach ($imgAttrs as $name => $value) {
            $imgAttrStr .= ' ' . e($name) . '="' . e((string) $value) . '"';
        }

        $pictureAttrStr = $pictureClass !== '' ? ' class="' . e($pictureClass) . '"' : '';

        $html = '<picture' . $pictureAttrStr . '>';
        if ($webpSrcset !== '') {
            $html .= '<source type="image/webp" srcset="' . e($webpSrcset) . '" sizes="' . e($sizesVal) . '">';
        }
        if ($jpegSrcset !== '') {
            $html .= '<source type="image/jpeg" srcset="' . e($jpegSrcset) . '" sizes="' . e($sizesVal) . '">';
        }
        $html .= '<img' . $imgAttrStr . '>';
        $html .= '</picture>';

        return $html;
    }

    // -----------------------------------------------------------------------
    // Fallback: einfaches <img> (SVG, Placeholder, kein Build gelaufen)
    // -----------------------------------------------------------------------
    $defaults = [
        'src'      => $src,
        'alt'      => $altVal,
        'loading'  => $priority ? 'eager' : 'lazy',
        'decoding' => 'async',
    ];

    if ($priority) {
        $defaults['fetchpriority'] = 'high';
    }
    if ($imgWidth !== null) {
        $defaults['width'] = $imgWidth;
    }
    if ($imgHeight !== null) {
        $defaults['height'] = $imgHeight;
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
