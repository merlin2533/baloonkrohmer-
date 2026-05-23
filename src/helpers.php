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
 * Gibt den Pfad zu einer Asset-Datei zurück (/assets/...)
 */
function asset(string $path): string
{
    return '/assets/' . ltrim($path, '/');
}
