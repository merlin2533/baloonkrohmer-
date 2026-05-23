<?php
/**
 * Ballonsport Krohmer — JavaScript-Minifizierung
 *
 * Verwendung:
 *   php bin/build-js.php
 *
 * Was es tut:
 *   - Entfernt einzeilige Kommentare (// ...) außerhalb von Strings
 *   - Entfernt mehrzeilige Kommentare (/* ... *\/)
 *   - Reduziert Mehrfach-Whitespace (Tabs, mehrere Leerzeichen) auf eines
 *   - Entfernt führende/nachfolgende Whitespace pro Zeile
 *   - Schreibt public/assets/js/main.min.js
 *
 * Hinweis: Dies ist eine konservative Minifizierung ohne Parser (kein UglifyJS).
 * Reguläre Ausdrücke in JS-Strings können in Grenzfällen falsch behandelt werden.
 * Für Produktionseinsatz empfiehlt sich zusätzlich ein echtes Tool wie esbuild.
 *
 * Wann ausführen:
 *   Nach jeder Änderung an main.js. Der asset()-Helper lädt automatisch
 *   die .min-Version, wenn sie existiert.
 */

declare(strict_types=1);

$root = dirname(__DIR__);

$files = [
    $root . '/public/assets/js/main.js' => $root . '/public/assets/js/main.min.js',
];

foreach ($files as $src => $dst) {
    if (!file_exists($src)) {
        echo "SKIP (nicht gefunden): $src\n";
        continue;
    }

    $js = file_get_contents($src);
    if ($js === false) {
        echo "FEHLER: Konnte $src nicht lesen\n";
        continue;
    }

    $before = strlen($js);

    // 1. Mehrzeilige Kommentare entfernen (/* ... */) — vor einzeiligen
    $js = preg_replace('/\/\*[\s\S]*?\*\//', '', $js);

    // 2. Einzeilige Kommentare entfernen (// ...) — nur außerhalb von Strings (einfache Heuristik)
    //    Wir verarbeiten Zeile für Zeile, um String-Literal-Kollisionen zu minimieren.
    $lines = explode("\n", $js);
    $result = [];
    foreach ($lines as $line) {
        // Einzeiligen Kommentar am Ende der Zeile entfernen
        // Heuristik: entferne // und alles dahinter, sofern nicht in einem String
        $stripped = preg_replace('/(?<![\'"])\/\/(?![\'"]).*$/', '', $line);
        $trimmed  = trim((string) $stripped);
        if ($trimmed !== '') {
            $result[] = $trimmed;
        }
    }
    $js = implode("\n", $result);

    // 3. Mehrfache Leerzeichen (horizontal) reduzieren
    $js = preg_replace('/[ \t]+/', ' ', $js);

    // 4. Mehrfache Leerzeilen reduzieren
    $js = preg_replace('/\n{3,}/', "\n\n", $js);

    // 5. Trim
    $js = trim((string) $js);

    $after = strlen($js);

    $written = file_put_contents($dst, $js);
    if ($written === false) {
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
