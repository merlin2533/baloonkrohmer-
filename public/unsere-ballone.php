<?php
require __DIR__ . '/../src/bootstrap.php';
$breadcrumbs = [
    ['name' => 'Start',         'url' => '/'],
    ['name' => 'Unsere Ballone','url' => '/unsere-ballone.php'],
];
seo_head([
    'title'        => t('ballone_title', 'Unsere Ballone'),
    'description'  => t('ballone_lead', 'Drei Heißluftballone für jedes Erlebnis — von Einzelgästen bis zur Gruppe.'),
    'canonical'    => 'https://www.ballonsport-krohmer.de/unsere-ballone.php',
    'og_image_key' => 'ballon_dogkr',
    'breadcrumbs'  => $breadcrumbs,
]);
include __DIR__ . '/../src/partials/header.php';
include __DIR__ . '/../src/partials/breadcrumbs.php';
?>

<!-- =====================================================================
     PAGE HERO (kompakt)
     ===================================================================== -->
<section class="hero hero--compact" aria-label="<?= t('ballone_title') ?>">
    <div class="hero__overlay" style="background:linear-gradient(135deg,rgba(11,23,38,.7) 0%,rgba(30,58,95,.5) 100%)"></div>
    <div class="container hero__inner">
        <h1 class="hero__title"><?= t('ballone_title') ?></h1>
        <p class="hero__sub"><?= t('ballone_lead') ?></p>
    </div>
</section>

<!-- =====================================================================
     BALLONE — 3-SPALTEN-GRID
     ===================================================================== -->
<section class="section" aria-labelledby="ballone-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="ballone-heading">Unsere drei Heißluftballone</h2>
            <p class="section__lead">Jeder Korb fasst 5 Passagiere plus Pilot — für ein persönliches Erlebnis.</p>
        </div>
        <div class="grid grid--3">

            <article class="card ballon-card">
                <?= img('ballon_dogkr', t('ballon_dogkr_name'), ['class' => 'card__img ballon-card__img', 'loading' => 'lazy']) ?>
                <div class="card__body">
                    <span class="badge" style="margin-bottom:var(--space-3)">D-OGKR</span>
                    <h3 class="card__title"><?= t('ballon_dogkr_name') ?></h3>
                    <p class="card__text"><?= t('ballon_dogkr_text') ?></p>
                    <p class="ballon-card__capacity">
                        <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" width="16" height="16" style="color:var(--c-sky-500);vertical-align:middle">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        5 Passagiere + Pilot pro Korb
                    </p>
                </div>
            </article>

            <article class="card ballon-card">
                <?= img('ballon_doaak', t('ballon_doaak_name'), ['class' => 'card__img ballon-card__img', 'loading' => 'lazy']) ?>
                <div class="card__body">
                    <span class="badge" style="margin-bottom:var(--space-3)">D-OAAK</span>
                    <h3 class="card__title"><?= t('ballon_doaak_name') ?></h3>
                    <p class="card__text"><?= t('ballon_doaak_text') ?></p>
                    <p class="ballon-card__capacity">
                        <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" width="16" height="16" style="color:var(--c-sky-500);vertical-align:middle">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        5 Passagiere + Pilot pro Korb
                    </p>
                </div>
            </article>

            <article class="card ballon-card">
                <?= img('ballon_doaam', t('ballon_doaam_name'), ['class' => 'card__img ballon-card__img', 'loading' => 'lazy']) ?>
                <div class="card__body">
                    <span class="badge" style="margin-bottom:var(--space-3)">D-OAAM</span>
                    <h3 class="card__title"><?= t('ballon_doaam_name') ?></h3>
                    <p class="card__text"><?= t('ballon_doaam_text') ?></p>
                    <p class="ballon-card__capacity">
                        <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" width="16" height="16" style="color:var(--c-sky-500);vertical-align:middle">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                        5 Passagiere + Pilot pro Korb
                    </p>
                </div>
            </article>

        </div>
    </div>
</section>

<!-- =====================================================================
     GRUPPEN-INFO-BLOCK
     ===================================================================== -->
<section class="section section--alt" aria-labelledby="gruppe-heading">
    <div class="container">
        <div class="info-block">
            <div class="info-block__icon">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="info-block__content">
                <h2 class="info-block__title" id="gruppe-heading">Für Gruppen: Bis zu 4 Ballone gleichzeitig</h2>
                <p class="info-block__text">Wir können bis zu vier Ballone gleichzeitig in die Luft schicken — das macht bis zu 25 Passagiere auf einmal möglich. Ideal für Firmenevents, Vereinsausflüge oder besondere Anlässe.</p>
                <a href="/kontakt.php?betreff=Gruppenfahrt" class="btn btn-primary">Gruppenanfrage stellen</a>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================================
     SO FUNKTIONIERT EIN HEIßLUFTBALLON
     ===================================================================== -->
<section class="section" aria-labelledby="technik-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="technik-heading">So funktioniert ein Heißluftballon</h2>
            <p class="section__lead">Physik, die begeistert — kurz und verständlich erklärt.</p>
        </div>
        <div class="prose prose--wide">
            <?= t_raw('ballone_technik_html') ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../src/partials/cta_bar.php'; ?>
<?php include __DIR__ . '/../src/partials/footer.php'; ?>
