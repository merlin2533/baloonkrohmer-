<?php
/**
 * Ballonsport Krohmer — CTA-Sektion
 *
 * Wiederverwendbare CTA-Leiste "Bereit für Ihr Ballonerlebnis?".
 * Kann mit optionalen Parametern angepasst werden:
 *
 *   $cta_heading  (string) — Überschrift (Default: "Bereit für Ihr Ballonerlebnis?")
 *   $cta_text     (string) — Begleittext
 *   $cta_mod      (string) — zusätzliche CSS-Modifier-Klasse für .cta-bar
 */

$cta_heading = $cta_heading ?? 'Bereit für Ihr Ballonerlebnis?';
$cta_text    = $cta_text    ?? 'Rufen Sie uns an oder schreiben Sie uns — wir freuen uns auf Ihre Anfrage.';
$cta_mod     = $cta_mod     ?? '';
?>
<section class="cta-bar <?= e($cta_mod) ?>" aria-labelledby="cta-heading">
    <div class="container cta-bar__inner">
        <div class="cta-bar__content">
            <h2 class="cta-bar__heading" id="cta-heading"><?= e($cta_heading) ?></h2>
            <p class="cta-bar__text"><?= e($cta_text) ?></p>
        </div>
        <div class="cta-bar__actions">
            <a href="tel:+49712721173" class="btn btn-primary btn-lg">
                <svg class="icon" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" width="18" height="18">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                </svg>
                Jetzt anrufen
            </a>
            <a href="/kontakt.php" class="btn btn-ghost btn-lg">
                Anfrage senden
            </a>
        </div>
    </div>
</section>
