<?php
require __DIR__ . '/../src/bootstrap.php';
$breadcrumbs = [
    ['name' => 'Start',              'url' => '/'],
    ['name' => 'Datenschutz',        'url' => '/datenschutz.php'],
];
seo_head([
    'title'        => 'Datenschutzerklärung',
    'description'  => 'Datenschutzerklärung von Ballonsport Krohmer gemäß DSGVO.',
    'canonical'    => 'https://www.ballonsport-krohmer.de/datenschutz.php',
    'og_image_key' => 'og_default',
    'breadcrumbs'  => $breadcrumbs,
    'noindex'      => true,
]);
include __DIR__ . '/../src/partials/header.php';
include __DIR__ . '/../src/partials/breadcrumbs.php';
?>

<!-- =====================================================================
     PAGE HERO (kompakt)
     ===================================================================== -->
<section class="hero hero--compact" aria-label="Datenschutzerklärung">
    <div class="hero__overlay" style="background:linear-gradient(135deg,rgba(11,23,38,.7) 0%,rgba(30,58,95,.5) 100%)"></div>
    <div class="container hero__inner">
        <h1 class="hero__title">Datenschutzerklärung</h1>
    </div>
</section>

<!-- =====================================================================
     INHALT
     ===================================================================== -->
<section class="section" aria-labelledby="datenschutz-content">
    <div class="container">
        <div class="prose prose--narrow">
            <?= t_raw('datenschutz_html') ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../src/partials/footer.php'; ?>
