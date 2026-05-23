<?php
require __DIR__ . '/../src/bootstrap.php';
seo_head([
    'title'       => 'Impressum',
    'description' => 'Impressum von Ballonsport Krohmer — Angaben gemäß § 5 TMG.',
    'canonical'   => 'https://www.ballonsport-krohmer.de/impressum.php',
    'og_image_key' => 'og_default',
]);
include __DIR__ . '/../src/partials/header.php';
?>

<!-- =====================================================================
     PAGE HERO (kompakt)
     ===================================================================== -->
<section class="hero hero--compact" aria-label="Impressum">
    <div class="hero__overlay" style="background:linear-gradient(135deg,rgba(11,23,38,.7) 0%,rgba(30,58,95,.5) 100%)"></div>
    <div class="container hero__inner">
        <h1 class="hero__title">Impressum</h1>
    </div>
</section>

<!-- =====================================================================
     INHALT
     ===================================================================== -->
<section class="section" aria-labelledby="impressum-content">
    <div class="container">
        <div class="prose prose--narrow">
            <?= t_raw('impressum_html') ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../src/partials/footer.php'; ?>
