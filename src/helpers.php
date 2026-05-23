<?php
/**
 * Ballonsport Krohmer — Allgemeine Helper-Funktionen
 */

/**
 * HTML-escaping (UTF-8)
 */
function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Baut eine absolute URL relativ zur site_url
 */
function url(string $path = ''): string
{
    global $CFG;
    $base = rtrim($CFG['site_url'] ?? '', '/');
    if ($path === '' || $path === '/') {
        return $base . '/';
    }
    return $base . '/' . ltrim($path, '/');
}

/**
 * Gibt den Pfad zu einer Asset-Datei zurück.
 *
 * Features:
 * - Transparente .min-Version: asset('/assets/css/styles.css') liefert
 *   automatisch /assets/css/styles.min.css, wenn diese Datei existiert.
 * - Cache-Busting per ?v=<filemtime> für alle Assets unter /assets/ und /uploads/.
 * - Ergebnis wird pro Request gecacht (kein wiederholtes stat()).
 *
 * @param string $path  Absoluter Pfad relativ zu public/ (z. B. /assets/css/styles.css)
 */
function asset(string $path): string
{
    static $cache = [];

    $path = '/' . ltrim($path, '/');

    if (isset($cache[$path])) {
        return $cache[$path];
    }

    // Prüfen, ob eine .min-Version existiert (nur für .css und .js)
    $servePath = $path;
    if (preg_match('/^(.+)\.(css|js)$/', $path, $m)) {
        $minPath    = $m[1] . '.min.' . $m[2];
        $minAbsPath = defined('ROOT') ? ROOT . '/public' . $minPath : '';
        if ($minAbsPath !== '' && file_exists($minAbsPath)) {
            $servePath = $minPath;
        }
    }

    // Cache-Busting per filemtime (nur für /assets/ und /uploads/)
    $versioned = $servePath;
    if (
        str_starts_with($servePath, '/assets/') ||
        str_starts_with($servePath, '/uploads/')
    ) {
        $absPath = defined('ROOT') ? ROOT . '/public' . $servePath : '';
        if ($absPath !== '' && file_exists($absPath)) {
            $mtime = @filemtime($absPath);
            if ($mtime !== false) {
                $versioned = $servePath . '?v=' . $mtime;
            }
        }
    }

    $cache[$path] = $versioned;
    return $versioned;
}
