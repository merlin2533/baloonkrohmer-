<?php
require __DIR__ . '/../src/bootstrap.php';
seo_head([
    'title'             => t('ballonfahren_title', 'Ballonfahren'),
    'description'       => t('ballonfahren_lead', 'Heißluftballonfahrten über der Schwäbischen Alb — Tübingen, Reutlingen, Stuttgart.'),
    'canonical'         => 'https://www.ballonsport-krohmer.de/ballonfahren.php',
    'og_image_key'      => 'ballonfahren_hero',
    'preload_image_key' => 'ballonfahren_hero',
]);
include __DIR__ . '/../src/partials/header.php';
?>

<!-- =====================================================================
     PAGE HERO (kompakt)
     ===================================================================== -->
<section class="hero hero--compact" aria-label="<?= t('ballonfahren_title') ?>">
    <?= img('ballonfahren_hero', 'Ballonfahrt über die Schwäbische Alb', [
        'class'    => 'hero__bg',
        'priority' => true,
        'sizes'    => '100vw',
    ]) ?>
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <h1 class="hero__title"><?= t('ballonfahren_title') ?></h1>
        <p class="hero__sub"><?= t('ballonfahren_lead') ?></p>
    </div>
</section>

<!-- =====================================================================
     HAUPTINHALT
     ===================================================================== -->
<section class="section" aria-labelledby="ballonfahren-intro">
    <div class="container">
        <div class="prose prose--wide">
            <?= t_raw('ballonfahren_intro_html') ?>
        </div>
    </div>
</section>

<!-- =====================================================================
     DREI-SPALTEN-BLOCK
     ===================================================================== -->
<section class="section section--alt" aria-labelledby="details-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="details-heading">Alles Wissenswerte</h2>
        </div>
        <div class="grid grid--3">

            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <h3 class="card__title">Startorte</h3>
                    <ul class="info-list">
                        <li>Tübingen</li>
                        <li>Reutlingen</li>
                        <li>Stuttgart</li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="2" y1="12" x2="22" y2="12"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                    </div>
                    <h3 class="card__title">Region</h3>
                    <ul class="info-list">
                        <li>Schwäbische Alb</li>
                        <li>Balingen</li>
                        <li>Hechingen</li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <h3 class="card__title">Erlebnis</h3>
                    <ul class="info-list">
                        <li>Ca. 1,5 h Flugzeit</li>
                        <li>4–5 h Gesamtzeit</li>
                        <li>Lautlos schweben</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =====================================================================
     WAS WIR BIETEN — 4 CARDS
     ===================================================================== -->
<section class="section" aria-labelledby="angebot-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="angebot-heading">Was wir bieten</h2>
        </div>
        <div class="grid grid--4">

            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                    <h3 class="card__title">Konzepterstellung</h3>
                    <p class="card__text">Individuelle Planung Ihrer Ballonfahrt — abgestimmt auf Ihre Wünsche und Gruppe.</p>
                </div>
            </div>

            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28">
                            <path d="M20 12V22H4V12"/>
                            <path d="M22 7H2v5h20V7z"/>
                            <path d="M12 22V7"/>
                            <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/>
                            <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/>
                        </svg>
                    </div>
                    <h3 class="card__title">Geschenkgutscheine</h3>
                    <p class="card__text">Verschenken Sie ein unvergessliches Erlebnis — per Telefon oder E-Mail erhältlich.</p>
                </div>
            </div>

            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3 class="card__title">Persönliche Betreuung</h3>
                    <p class="card__text">Von der Anfrage bis zur Landung sind wir persönlich für Sie da.</p>
                </div>
            </div>

            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <line x1="3" y1="9" x2="21" y2="9"/>
                            <line x1="3" y1="15" x2="21" y2="15"/>
                            <line x1="9" y1="3" x2="9" y2="21"/>
                            <line x1="15" y1="3" x2="15" y2="21"/>
                        </svg>
                    </div>
                    <h3 class="card__title">Rahmenprogramme</h3>
                    <p class="card__text">Ergänzen Sie Ihre Fahrt mit individuellen Rahmenprogrammen für Gruppen und Events.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include __DIR__ . '/../src/partials/cta_bar.php'; ?>
<?php include __DIR__ . '/../src/partials/footer.php'; ?>
