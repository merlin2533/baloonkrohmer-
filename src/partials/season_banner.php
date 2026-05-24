<?php
/**
 * Saisonaler Banner — dynamisch nach Monat
 * Einbinden: include __DIR__ . '/../src/partials/season_banner.php';
 */

$y = (int)date('Y');
$m = (int)date('n');

if ($m >= 1 && $m <= 4) {
    $bannerText = "Termine Mai–Oktober {$y} jetzt sichern";
    $bannerVariant = 'Booking starten';
} elseif ($m >= 5 && $m <= 8) {
    $bannerText = "Saison {$y} läuft — kurzfristige Termine möglich";
    $bannerVariant = 'Aktuell verfügbar';
} elseif ($m >= 9 && $m <= 10) {
    $bannerText = "Letzte Termine für {$y} buchen — Saison endet bald";
    $bannerVariant = 'Aktuell verfügbar';
} else {
    // November–Dezember
    $nextYear = $y + 1;
    $bannerText = "Saison {$y} beendet — Gutscheine für {$nextYear} jetzt verschenken";
    $bannerVariant = 'Gutschein';
}
?>
<div class="season-banner" role="region" aria-label="Aktuelle Saison">
    <div class="container season-banner__inner">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12 2C8 2 5 5.5 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.5-3-7-7-7z"/>
            <circle cx="12" cy="9" r="2.5"/>
        </svg>
        <span class="season-banner__text"><?= e($bannerText) ?></span>
        <a href="/kontakt.php" class="season-banner__cta">Verfügbarkeit prüfen →</a>
    </div>
</div>
