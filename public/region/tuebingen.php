<?php
require __DIR__ . '/../../src/bootstrap.php';

$breadcrumbs = [
    ['name' => 'Start',                 'url' => '/'],
    ['name' => 'Ballonfahrt Tübingen',  'url' => '/region/tuebingen.php'],
];

seo_head([
    'title'        => t('region_tuebingen_title', 'Ballonfahrt Tübingen'),
    'description'  => t('region_tuebingen_desc',  'Heißluftballon fahren über Tübingen, dem Neckar und der Schwäbischen Alb — Ballonsport Krohmer aus Pliezhausen. Seit 1998.'),
    'canonical'    => 'https://www.ballonsport-krohmer.de/region/tuebingen.php',
    'og_image_key' => 'og_default',
    'breadcrumbs'  => $breadcrumbs,
    'extra_json_ld' => [[
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        'name'        => 'Ballonfahrt Tübingen',
        'serviceType' => 'Heißluftballonfahrt',
        'provider'    => [
            '@type' => 'LocalBusiness',
            'name'  => 'Ballonsport Krohmer',
            'url'   => 'https://www.ballonsport-krohmer.de/',
        ],
        'areaServed' => [
            '@type' => 'City',
            'name'  => 'Tübingen',
        ],
        'offers' => [
            '@type'         => 'Offer',
            'price'         => '235',
            'priceCurrency' => 'EUR',
            'url'           => 'https://www.ballonsport-krohmer.de/preise.php',
        ],
        'url' => 'https://www.ballonsport-krohmer.de/region/tuebingen.php',
    ]],
]);
include __DIR__ . '/../../src/partials/header.php';
include __DIR__ . '/../../src/partials/breadcrumbs.php';
?>

<!-- =====================================================================
     PAGE HERO (kompakt)
     ===================================================================== -->
<section class="hero hero--compact" aria-label="Ballonfahrt Tübingen">
    <div class="hero__overlay" style="background:linear-gradient(135deg,rgba(11,23,38,.72) 0%,rgba(30,58,95,.5) 100%)"></div>
    <div class="container hero__inner">
        <h1 class="hero__title"><?= t('region_tuebingen_title', 'Ballonfahrt Tübingen') ?></h1>
        <p class="hero__sub"><?= t('region_tuebingen_subtitle', 'Über Tübingen, den Neckar und die Alb — mit Ballonsport Krohmer in die Lüfte') ?></p>
    </div>
</section>

<!-- =====================================================================
     HAUPTINHALT
     ===================================================================== -->
<section class="section" aria-labelledby="tuebingen-intro-heading">
    <div class="container">
        <h2 class="section__title" id="tuebingen-intro-heading" style="margin-bottom:var(--space-6)">Heißluftballon fahren über Tübingen</h2>
        <div class="prose prose--wide">
            <?= t_raw('region_tuebingen_intro_html') ?>
        </div>
    </div>
</section>

<!-- =====================================================================
     DETAILS
     ===================================================================== -->
<section class="section section--alt" aria-labelledby="tuebingen-details-heading">
    <div class="container">
        <div class="grid grid--3">
            <div class="card">
                <div class="card__body">
                    <h3 class="card__title">Historisches Panorama</h3>
                    <p class="card__text">Von oben sehen Sie Tübingens Stiftskirche, das Schloss Hohentübingen und den Neckar-Bogen — ein Anblick, den nur wenige Menschen je erleben.</p>
                </div>
            </div>
            <div class="card">
                <div class="card__body">
                    <h3 class="card__title">Preis ab 235 €</h3>
                    <p class="card__text">Erwachsene fahren ab 235 € pro Person, Kinder und Jugendliche bis 18 Jahre ab 210 €. Alle Preise inklusive Versicherung.</p>
                </div>
            </div>
            <div class="card">
                <div class="card__body">
                    <h3 class="card__title">Nah bei Ihnen</h3>
                    <p class="card__text">Pliezhausen liegt direkt zwischen Tübingen und Reutlingen — kurze Anreise, riesiges Erlebnis.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================================
     CTA
     ===================================================================== -->
<section class="section" aria-label="Anfrage Tübingen">
    <div class="container" style="text-align:center">
        <h2 class="section__title" style="margin-bottom:var(--space-4)">Ballonfahrt Tübingen jetzt anfragen</h2>
        <p style="color:var(--c-ink-500);margin-bottom:var(--space-8);max-width:55ch;margin-inline:auto">
            Wir freuen uns auf Ihre Anfrage — telefonisch oder per E-Mail.
        </p>
        <div style="display:flex;gap:var(--space-4);justify-content:center;flex-wrap:wrap">
            <a href="/kontakt.php?betreff=Termin+anfragen" class="btn btn-primary btn-lg">Termin anfragen</a>
            <a href="/preise.php" class="btn btn-ghost btn-lg">Alle Preise ansehen</a>
        </div>
        <p style="margin-top:var(--space-6);color:var(--c-ink-300);font-size:0.875rem">
            Mehr Informationen: <a href="/faq.php">Häufig gestellte Fragen</a> · <a href="/ballonfahren.php">Ablauf einer Ballonfahrt</a>
        </p>
    </div>
</section>

<?php include __DIR__ . '/../../src/partials/footer.php'; ?>
