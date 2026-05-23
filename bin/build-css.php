<?php
/**
 * Ballonsport Krohmer — CSS-Minifizierung
 *
 * Verwendung:
 *   php bin/build-css.php
 *
 * Was es tut:
 *   - Entfernt CSS-Kommentare (/* ... *\/)
 *   - Entfernt führende/nachfolgende Whitespace pro Zeile
 *   - Entfernt unnötige Leerzeichen um Sonderzeichen ({, }, :, ;, ,, >, +, ~)
 *   - Schreibt public/assets/css/styles.min.css und admin.min.css
 *
 * Wann ausführen:
 *   Nach jeder Änderung an styles.css oder admin.css, damit die .min-Versionen
 *   aktuell bleiben. Der asset()-Helper lädt automatisch die .min-Version,
 *   wenn sie existiert.
 */

declare(strict_types=1);

$root = dirname(__DIR__);

$files = [
    $root . '/public/assets/css/styles.css' => $root . '/public/assets/css/styles.min.css',
    $root . '/public/assets/css/admin.css'  => $root . '/public/assets/css/admin.min.css',
];

foreach ($files as $src => $dst) {
    if (!file_exists($src)) {
        echo "SKIP (nicht gefunden): $src\n";
        continue;
    }

    $css = file_get_contents($src);
    if ($css === false) {
        echo "FEHLER: Konnte $src nicht lesen\n";
        continue;
    }

    $before = strlen($css);

    // 1. Kommentare entfernen (/* ... */)
    $css = preg_replace('/\/\*[\s\S]*?\*\//', '', $css);

    // 2. Leerzeichen um Sonderzeichen normalisieren
    $css = preg_replace('/\s*([{}:;,>+~])\s*/', '$1', $css);

    // 3. Mehrfach-Whitespace (inkl. Newlines) auf einzelnes Leerzeichen reduzieren
    $css = preg_replace('/\s+/', ' ', $css);

    // 4. Führende und abschließende Leerzeichen entfernen
    $css = trim((string) $css);

    $after = strlen($css);

    $result = file_put_contents($dst, $css);
    if ($result === false) {
        echo "FEHLER: Konnte $dst nicht schreiben\n";
        continue;
    }

    $saving = $before > 0 ? round((1 - $after / $before) * 100, 1) : 0;
    echo sprintf(
        "OK: %s → %s  (%d → %d Bytes, −%s%%)\n",
        basename($src),
        basename($dst),
        $before,
        $after,
        $saving
    );
}

echo "Fertig.\n";
