<?php
/**
 * Ballonsport Krohmer — Content-Helper
 *
 * t()      — gibt escaped Text aus der DB zurück
 * t_raw()  — gibt rohen HTML-Inhalt zurück (nur für *_html-Keys verwenden)
 * set_content() — speichert/aktualisiert einen Content-Key
 * all_content_keys() — gibt alle vorhandenen Keys zurück
 */

/**
 * Liest einen Content-Wert aus der DB und gibt ihn HTML-escaped zurück.
 * Für HTML-Keys (*_html) stattdessen t_raw() verwenden.
 */
function t(string $key, string $default = ''): string
{
    static $cache = [];

    if (!isset($cache[$key])) {
        $stmt = db()->prepare('SELECT value FROM content WHERE key = :key');
        $stmt->execute([':key' => $key]);
        $row = $stmt->fetch();
        $cache[$key] = $row !== false ? $row['value'] : null;
    }

    $value = $cache[$key] ?? $default;
    return e($value);
}

/**
 * Liest einen Content-Wert und gibt ihn unescaped zurück.
 * Nur für vertrauenswürdige HTML-Inhalte (*_html-Keys) verwenden.
 */
function t_raw(string $key, string $default = ''): string
{
    static $cache = [];

    if (!isset($cache[$key])) {
        $stmt = db()->prepare('SELECT value FROM content WHERE key = :key');
        $stmt->execute([':key' => $key]);
        $row = $stmt->fetch();
        $cache[$key] = $row !== false ? $row['value'] : null;
    }

    return $cache[$key] ?? $default;
}

/**
 * Speichert oder aktualisiert einen Content-Key in der DB.
 */
function set_content(string $key, string $value): void
{
    $stmt = db()->prepare(
        'INSERT INTO content (key, value, updated_at)
         VALUES (:key, :value, :now)
         ON CONFLICT(key) DO UPDATE SET value = :value, updated_at = :now'
    );
    $stmt->execute([':key' => $key, ':value' => $value, ':now' => time()]);
}

/**
 * Gibt alle vorhandenen Content-Keys zurück.
 *
 * @return string[]
 */
function all_content_keys(): array
{
    $stmt = db()->query('SELECT key FROM content ORDER BY key');
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
