<?php
/**
 * Einmal-Skript: Registriert alle aus dem Original-Site heruntergeladenen
 * Bilder im SQLite (images-Tabelle).
 *
 * Aufruf:  php bin/register-originals.php
 *
 * Idempotent — kann beliebig oft laufen.
 */

require __DIR__ . '/../src/bootstrap.php';

$mapping = [
    'logo'              => ['file' => 'logo.png',              'alt' => 'Ballonsport Krohmer'],
    'hero_main'         => ['file' => 'hero_main.jpg',         'alt' => 'Heißluftballon über der Schwäbischen Alb bei Sonnenaufgang'],
    'home_about'        => ['file' => 'hero_main.jpg',         'alt' => 'Heißluftballon startet bei Sonnenaufgang'],
    'ballonfahren_hero' => ['file' => 'ballonfahren_hero.jpg', 'alt' => 'Ballonfahrt über die Schwäbische Alb'],
    'preise_hero'       => ['file' => 'preise_hero.jpg',       'alt' => 'Preise und Pakete für Ballonfahrten'],
    'kontakt_hero'      => ['file' => 'kontakt_hero.jpg',      'alt' => 'Kontakt zu Ballonsport Krohmer'],
    'ballon_dogkr'      => ['file' => 'ballon_dogkr.jpg',      'alt' => 'Heißluftballon D-OGKR Krohmer'],
    'ballon_doaak'      => ['file' => 'ballon_doaak.jpg',      'alt' => 'Heißluftballon D-OAAK Alpirsbacher'],
    'ballon_doaam'      => ['file' => 'ballon_doaam.jpg',      'alt' => 'Heißluftballon D-OAAM Wolff und Müller'],
    'og_default'        => ['file' => 'hero_main.jpg',         'alt' => 'Ballonsport Krohmer'],
];

for ($i = 1; $i <= 15; $i++) {
    $num = str_pad((string)$i, 2, '0', STR_PAD_LEFT);
    $mapping["gallery_{$num}"] = [
        'file' => "gallery_{$num}.jpg",
        'alt'  => "Eindruck einer Ballonfahrt — Bild {$i}",
    ];
}

$uploadDir = __DIR__ . '/../public/uploads';
$ok = 0;
$fail = 0;
foreach ($mapping as $key => $info) {
    $path = $uploadDir . '/' . $info['file'];
    if (!is_file($path)) {
        echo "MISSING FILE for key=$key file={$info['file']}\n";
        $fail++;
        continue;
    }
    set_image($key, $info['file'], $info['alt']);
    echo "OK  $key  →  {$info['file']}\n";
    $ok++;
}

echo "---\n";
echo "Registriert: $ok   Fehlgeschlagen: $fail\n";
