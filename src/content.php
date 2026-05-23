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
 * Interner Cache für alle Content-Rows (wird beim ersten Zugriff befüllt).
 * Gibt das gecachte Array zurück (als Referenz, damit set_content() es mutieren kann).
 *
 * @return array<string,string|null>
 */
function &_content_cache(): array
{
    static $cache = null;

    if ($cache === null) {
        $cache = [];
        $rows = db()->query('SELECT key, value FROM content')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $cache[$row['key']] = $row['value'];
        }
    }

    return $cache;
}

/**
 * Liest einen Content-Wert aus der DB und gibt ihn HTML-escaped zurück.
 * Für HTML-Keys (*_html) stattdessen t_raw() verwenden.
 */
function t(string $key, string $default = ''): string
{
    $cache = &_content_cache();
    $value = array_key_exists($key, $cache) ? $cache[$key] : $default;
    return e((string) $value);
}

/**
 * Liest einen Content-Wert und gibt ihn unescaped zurück.
 * Nur für vertrauenswürdige HTML-Inhalte (*_html-Keys) verwenden.
 */
function t_raw(string $key, string $default = ''): string
{
    $cache = &_content_cache();
    return array_key_exists($key, $cache) ? (string) $cache[$key] : $default;
}

/**
 * Speichert oder aktualisiert einen Content-Key in der DB.
 * Invalidiert den In-Request-Cache für den betroffenen Key.
 */
function set_content(string $key, string $value): void
{
    $stmt = db()->prepare(
        'INSERT INTO content (key, value, updated_at)
         VALUES (:key, :value, :now)
         ON CONFLICT(key) DO UPDATE SET value = :value, updated_at = :now'
    );
    $stmt->execute([':key' => $key, ':value' => $value, ':now' => time()]);

    // Cache aktualisieren
    $cache        = &_content_cache();
    $cache[$key]  = $value;
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
