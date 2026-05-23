<?php
http_response_code(404);
require __DIR__ . '/../src/bootstrap.php';
seo_head([
    'title'       => 'Seite nicht gefunden',
    'description' => 'Die gesuchte Seite konnte leider nicht gefunden werden. Bitte kehren Sie zur Startseite zurück.',
    'canonical'   => 'https://www.ballonsport-krohmer.de/',
    'noindex'     => true,
]);
include __DIR__ . '/../src/partials/header.php';
?>

<!-- =====================================================================
     404 HERO
     ===================================================================== -->
<section class="hero hero--compact" aria-label="Seite nicht gefunden">
    <div class="hero__overlay" style="background:linear-gradient(135deg,rgba(11,23,38,.75) 0%,rgba(30,58,95,.6) 100%)"></div>
    <div class="container hero__inner">
        <h1 class="hero__title">404 &mdash; Diese Seite ist leider abgehoben</h1>
        <p class="hero__sub">Die gewünschte Seite konnte nicht gefunden werden &mdash; vielleicht ist sie gerade irgendwo über der Schwäbischen Alb unterwegs.</p>
    </div>
</section>

<!-- =====================================================================
     404 INHALT
     ===================================================================== -->
<section class="section">
    <div class="container" style="max-width:640px; text-align:center; padding-top:3rem; padding-bottom:3rem;">

        <p style="font-size:1.125rem; color:var(--color-text-muted, #6b7280); margin-bottom:2rem;">
            Mögliche Ursachen: Die Seite wurde verschoben, gelöscht oder Sie haben sich bei der Adresse vertippt.
            Kein Problem &mdash; von hier aus finden Sie sicher wieder den richtigen Weg.
        </p>

        <div style="display:flex; gap:1rem; flex-wrap:wrap; justify-content:center;">
            <a href="/" class="btn btn-primary btn-lg">Zur Startseite</a>
            <a href="/kontakt.php" class="btn btn-ghost btn-lg">Kontakt aufnehmen</a>
        </div>

    </div>
</section>

<?php include __DIR__ . '/../src/partials/footer.php'; ?>
