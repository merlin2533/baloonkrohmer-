<?php
require __DIR__ . '/../src/bootstrap.php';
seo_head([
    'title'             => 'Ballonfahrten über der Schwäbischen Alb seit 1998',
    'description'       => 'Heißluftballonfahrten über der Schwäbischen Alb — Reutlingen, Tübingen, Stuttgart. Seit 1998. Registriertes Luftfahrtunternehmen, voll versichert.',
    'canonical'         => 'https://www.ballonsport-krohmer.de/',
    'og_image_key'      => 'hero_main',
    'preload_image_key' => 'hero_main',
]);
include __DIR__ . '/../src/partials/header.php';
?>

<!-- =====================================================================
     HERO
     ===================================================================== -->
<section class="hero hero--full" aria-label="Willkommen bei Ballonsport Krohmer">
    <img
        src="<?= img_url('hero_main') ?>"
        alt="Heißluftballon über der Schwäbischen Alb"
        class="hero__bg"
        loading="eager"
        fetchpriority="high"
    >
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <h1 class="hero__title"><?= t('hero_title') ?></h1>
        <p class="hero__sub"><?= t('hero_subtitle') ?></p>
        <div class="hero__ctas">
            <a href="/kontakt.php" class="btn btn-primary btn-lg">
                <?= t('hero_cta_primary', 'Jetzt Termin anfragen') ?>
            </a>
            <a href="/faq.php" class="btn btn-ghost btn-ghost--light btn-lg">
                <?= t('hero_cta_secondary', 'Häufig gestellte Fragen') ?>
            </a>
        </div>
    </div>
</section>

<!-- =====================================================================
     USP-SEKTION
     ===================================================================== -->
<section class="section section--alt" aria-labelledby="usp-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="usp-heading">Warum Ballonsport Krohmer?</h2>
        </div>
        <div class="grid grid--4">

            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <h3 class="card__title"><?= t('usp_1_title') ?></h3>
                    <p class="card__text"><?= t('usp_1_text') ?></p>
                </div>
            </div>

            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <h3 class="card__title"><?= t('usp_2_title') ?></h3>
                    <p class="card__text"><?= t('usp_2_text') ?></p>
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
                    <h3 class="card__title"><?= t('usp_3_title') ?></h3>
                    <p class="card__text"><?= t('usp_3_text') ?></p>
                </div>
            </div>

            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </div>
                    <h3 class="card__title"><?= t('usp_4_title') ?></h3>
                    <p class="card__text"><?= t('usp_4_text') ?></p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =====================================================================
     INTRO-SEKTION (zweispaltig)
     ===================================================================== -->
<section class="section" aria-labelledby="intro-heading">
    <div class="container">
        <div class="home-intro">
            <div class="home-intro__img">
                <?= img('home_about', 'Heißluftballon startet bei Sonnenaufgang', ['class' => 'home-intro__photo', 'loading' => 'lazy']) ?>
            </div>
            <div class="home-intro__content">
                <h2 class="section__title" id="intro-heading">Ihr Ballonerlebnis über der Schwäbischen Alb</h2>
                <div class="prose">
                    <?= t_raw('home_intro_html') ?>
                </div>
                <div class="home-intro__actions">
                    <a href="/unsere-ballone.php" class="btn btn-primary">Mehr zu unseren Ballonen</a>
                    <a href="/preise.php" class="btn btn-ghost">Preise ansehen</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================================
     TRUST-BAR
     ===================================================================== -->
<div class="trust-bar" aria-label="Vertrauensmerkmale">
    <div class="container trust-bar__inner">
        <span class="badge">Seit 1998</span>
        <span class="badge">Über 20 Jahre Erfahrung</span>
        <span class="badge">Registriertes Luftfahrtunternehmen</span>
        <span class="badge">Voll versichert</span>
    </div>
</div>

<!-- =====================================================================
     HIGHLIGHT-3-SPALTER
     ===================================================================== -->
<section class="section section--alt" aria-labelledby="highlights-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="highlights-heading">Entdecken Sie unser Angebot</h2>
        </div>
        <div class="grid grid--3">

            <article class="card">
                <?= img('ballonfahren_hero', 'Ballonfahrt über die Schwäbische Alb', ['class' => 'card__img', 'loading' => 'lazy']) ?>
                <div class="card__body">
                    <h3 class="card__title">Ballonfahren</h3>
                    <p class="card__text">Lautlos durch die Luft — erleben Sie die Schwäbische Alb aus einer ganz neuen Perspektive.</p>
                    <a href="/ballonfahren.php" class="btn btn-ghost" style="margin-top:var(--space-4)">Mehr erfahren</a>
                </div>
            </article>

            <article class="card">
                <?= img('ballon_dogkr', 'Unsere Heißluftballone', ['class' => 'card__img', 'loading' => 'lazy']) ?>
                <div class="card__body">
                    <h3 class="card__title">Unsere Ballone</h3>
                    <p class="card__text">Drei Heißluftballone für Einzelgäste, Paare und Gruppen bis 25 Passagiere.</p>
                    <a href="/unsere-ballone.php" class="btn btn-ghost" style="margin-top:var(--space-4)">Zu den Ballonen</a>
                </div>
            </article>

            <article class="card">
                <?= img('preise_hero', 'Preise für Ballonfahrten', ['class' => 'card__img', 'loading' => 'lazy']) ?>
                <div class="card__body">
                    <h3 class="card__title">Preise</h3>
                    <p class="card__text">Transparente Tarife ab 210 € pro Person — inklusive Versicherung und unvergesslichem Erlebnis.</p>
                    <a href="/preise.php" class="btn btn-ghost" style="margin-top:var(--space-4)">Preise ansehen</a>
                </div>
            </article>

        </div>
    </div>
</section>

<?php include __DIR__ . '/../src/partials/cta_bar.php'; ?>
<?php include __DIR__ . '/../src/partials/footer.php'; ?>
