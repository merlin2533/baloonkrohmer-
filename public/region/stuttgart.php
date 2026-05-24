<?php
require __DIR__ . '/../../src/bootstrap.php';

$breadcrumbs = [
    ['name' => 'Start',                  'url' => '/'],
    ['name' => 'Ballonfahrt Stuttgart',  'url' => '/region/stuttgart.php'],
];

seo_head([
    'title'        => t('region_stuttgart_title', 'Ballonfahrt Stuttgart und Umgebung'),
    'description'  => t('region_stuttgart_desc',  'Heißluftballon fahren über Stuttgart und dem Stuttgarter Kessel — Ballonsport Krohmer aus Pliezhausen. Seit 1998.'),
    'canonical'    => 'https://www.ballonsport-krohmer.de/region/stuttgart.php',
    'og_image_key' => 'og_default',
    'breadcrumbs'  => $breadcrumbs,
    'extra_json_ld' => [[
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        'name'        => 'Ballonfahrt Stuttgart',
        'serviceType' => 'Heißluftballonfahrt',
        'provider'    => [
            '@type' => 'LocalBusiness',
            'name'  => 'Ballonsport Krohmer',
            'url'   => 'https://www.ballonsport-krohmer.de/',
        ],
        'areaServed' => [
            '@type' => 'City',
            'name'  => 'Stuttgart',
        ],
        'offers' => [
            '@type'         => 'Offer',
            'price'         => '235',
            'priceCurrency' => 'EUR',
            'url'           => 'https://www.ballonsport-krohmer.de/preise.php',
        ],
        'url' => 'https://www.ballonsport-krohmer.de/region/stuttgart.php',
    ]],
]);
include __DIR__ . '/../../src/partials/header.php';
include __DIR__ . '/../../src/partials/breadcrumbs.php';
?>

<!-- =====================================================================
     PAGE HERO (kompakt)
     ===================================================================== -->
<section class="hero hero--compact" aria-label="Ballonfahrt Stuttgart">
    <div class="hero__overlay" style="background:linear-gradient(135deg,rgba(11,23,38,.72) 0%,rgba(30,58,95,.5) 100%)"></div>
    <div class="container hero__inner">
        <h1 class="hero__title"><?= t('region_stuttgart_title', 'Ballonfahrt Stuttgart und Umgebung') ?></h1>
        <p class="hero__sub"><?= t('region_stuttgart_subtitle', 'Mit Ballonsport Krohmer über den Stuttgarter Kessel und die Schwäbische Alb schweben') ?></p>
    </div>
</section>

<!-- =====================================================================
     HAUPTINHALT
     ===================================================================== -->
<section class="section" aria-labelledby="stuttgart-intro-heading">
    <div class="container">
        <h2 class="section__title" id="stuttgart-intro-heading" style="margin-bottom:var(--space-6)">Heißluftballon fahren im Stuttgarter Raum</h2>
        <div class="prose prose--wide">
            <?= t_raw('region_stuttgart_intro_html') ?>
        </div>
    </div>
</section>

<!-- =====================================================================
     DETAILS
     ===================================================================== -->
<section class="section section--alt" aria-labelledby="stuttgart-details-heading">
    <div class="container">
        <div class="grid grid--3">
            <div class="card">
                <div class="card__body">
                    <h3 class="card__title">Startorte</h3>
                    <p class="card__text">Startorte im Südraum Stuttgart, im Filderbereich und je nach Windlage auch direkt am Stadtrand — immer abhängig von Wetter und Windrichtung.</p>
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
                    <h3 class="card__title">Buchung & Gutschein</h3>
                    <p class="card__text">Termin telefonisch oder per E-Mail vereinbaren. Geschenkgutscheine für Stuttgart und Umgebung sind ebenfalls erhältlich.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================================
     CTA
     ===================================================================== -->
<section class="section" aria-label="Anfrage Stuttgart">
    <div class="container" style="text-align:center">
        <h2 class="section__title" style="margin-bottom:var(--space-4)">Jetzt Ihre Stuttgarter Ballonfahrt anfragen</h2>
        <p style="color:var(--c-ink-500);margin-bottom:var(--space-8);max-width:55ch;margin-inline:auto">
            Wir beraten Sie gern — telefonisch Mo–Fr oder jederzeit per E-Mail.
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
