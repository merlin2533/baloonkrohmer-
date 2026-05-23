<?php
require __DIR__ . '/../src/bootstrap.php';
seo_head([
    'title'       => 'Vielen Dank für Ihre Anfrage',
    'description' => 'Ihre Anfrage ist eingegangen. Wir melden uns innerhalb von 1–2 Werktagen.',
    'canonical'   => 'https://www.ballonsport-krohmer.de/danke.php',
    'noindex'     => true,
]);
include __DIR__ . '/../src/partials/header.php';
?>

<section class="section" aria-labelledby="danke-heading">
    <div class="container">
        <div class="danke-box">
            <div class="danke-box__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="64" height="64" style="color:var(--c-sky-500)">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="9 12 11 14 15 10"/>
                </svg>
            </div>
            <h1 class="danke-box__title" id="danke-heading">Vielen Dank für Ihre Anfrage!</h1>
            <p class="danke-box__text">Wir haben Ihre Nachricht erhalten und melden uns innerhalb von <strong>1–2 Werktagen</strong> bei Ihnen.</p>
            <p class="danke-box__hint">
                Bei dringenden Anliegen rufen Sie uns gerne direkt an:<br>
                <a href="tel:+49712721173" class="danke-box__phone">07127 / 21173</a>
            </p>
            <div class="danke-box__actions">
                <a href="/" class="btn btn-primary">Zurück zur Startseite</a>
                <a href="/faq.php" class="btn btn-ghost">Häufige Fragen</a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../src/partials/footer.php'; ?>
