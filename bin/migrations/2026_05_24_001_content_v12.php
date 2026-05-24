<?php
/**
 * MIGRATION (auto-applied) — v1.2 Content-Refresh
 * Wird automatisch beim ersten Request nach Deploy ausgefuehrt.
 * Aktualisiert Hero-Texte, Leads und ergaenzt hero_anchor.
 *
 * ACHTUNG: Diese Migration ueberschreibt admin-editierte Werte fuer
 * die unten genannten Keys EINMALIG. Spaetere Admin-Edits bleiben
 * erhalten.
 */
/**
 * Ballonsport Krohmer — Content-Update v1.2
 *
 * Idempotentes Migrations-Skript: Aktualisiert alle Content-Keys für
 * Homepage Quick-Wins + Text-Refresh (Version 1.2).
 * Kann beliebig oft ausgeführt werden — set_content() überschreibt immer.
 *
 * Aufruf: php bin/v12-content-update.php
 */

declare(strict_types=1);

if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}

require ROOT . '/src/bootstrap.php';

$updates = [

    // =========================================================================
    // HERO — neue Texte (Aufgabe 1 + 5)
    // =========================================================================
    'hero_title'         => 'Schwäbische Alb von oben — seit 1998 mit Familie Krohmer',
    'hero_subtitle'      => 'Sonnenaufgang über Hohenzollern, lautlose Fahrt über die Alb-Hochfläche, Champagner-Taufe nach der Landung — Ihre Ballonfahrt ab 235 €.',
    'hero_cta_primary'   => 'Termin sichern — ab 235 €',
    'hero_cta_secondary' => 'Häufige Fragen',
    'hero_anchor'        => '1,5 Stunden Flug · 4–5 Stunden Gesamterlebnis · 5 Passagiere + Pilot pro Korb',

    // =========================================================================
    // HOME INTRO (Aufgabe 5)
    // =========================================================================
    'home_intro_html' => '<p>Willkommen bei Ballonsport Krohmer aus Pliezhausen. Seit 1998 begleiten wir Menschen auf ihre erste — und oft nicht letzte — Ballonfahrt über die Schwäbische Alb. Drei Heißluftballone, Startorte in Tübingen, Reutlingen und im Südraum Stuttgart, persönliche Betreuung von Familie Krohmer.</p>',

    // =========================================================================
    // BALLONFAHREN — Lead (Aufgabe 5, "lautlos"-Variante)
    // =========================================================================
    'ballonfahren_lead' => 'Über die Alb. Über den Wolken. Mit Ihnen — sicher, lautlos, persönlich.',

    // =========================================================================
    // PREISE — Lead (Aufgabe 5)
    // =========================================================================
    'preise_lead' => 'Klare Preise ab 235 € pro Person — inklusive Versicherung, Champagner-Taufe und Urkunde.',

    // =========================================================================
    // GALERIE — Lead (Aufgabe 5)
    // =========================================================================
    'galerie_lead' => 'Echte Bilder von echten Fahrten — über die Alb, durch das Schwäbische Mittelgebirge.',

    // =========================================================================
    // BALLONE — Lead (Aufgabe 5)
    // =========================================================================
    'ballone_lead' => 'Drei Ballone aus über 25 Jahren Erfahrung — vom kleinen Korb für fünf bis zur Gruppenfahrt mit bis zu vier Ballonen parallel.',

    // =========================================================================
    // PREISE — Gutschein (Aufgabe 5, "unvergesslich"-Variante)
    // =========================================================================
    'preise_voucher_html' => '<p>Verschenken Sie ein besonderes Erlebnis: <strong>Geschenkgutscheine</strong> erhalten Sie per Telefon oder E-Mail.</p>',

];

$count = 0;
foreach ($updates as $key => $value) {
    set_content($key, $value);
    $count++;
    echo "  OK {$key}\n";
}

echo "\nFertig: {$count} Keys aktualisiert.\n";
