<?php
require __DIR__ . '/../src/bootstrap.php';

// Critical CSS für LCP-Optimierung auf der Startseite (Above the fold)
$criticalCss = ':root{--c-sky-500:#0EA5E9;--c-sunset-500:#F97316;--c-ink-900:#0B1726;--c-ink-700:#1E3A5F;--c-bg:#FFFFFF;--c-paper:#FBFAF7;--c-line:#E5E7EB;--radius-md:8px;--space-2:.5rem;--space-3:.75rem;--space-4:1rem;--space-6:1.5rem;--space-8:2rem;--header-height:68px;--font-sans:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif;--font-display:"Playfair Display",Georgia,"Times New Roman",serif;--transition-fast:150ms ease;--shadow-sm:0 1px 3px rgb(0 0 0/.08),0 1px 2px rgb(0 0 0/.05)}*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}body{font-family:var(--font-sans);font-size:1rem;line-height:1.6;color:var(--c-ink-900);background:var(--c-bg)}.container{max-width:1200px;margin-inline:auto;padding-inline:1.25rem}.header{position:sticky;top:0;z-index:100;background:var(--c-bg);border-bottom:1px solid var(--c-line);height:var(--header-height)}.hero{position:relative;overflow:hidden;display:flex;align-items:center}.hero--full{min-height:100svh}.hero__bg{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}.hero__overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(11,23,38,.65) 0%,rgba(30,58,95,.45) 100%)}.hero__inner{position:relative;z-index:1;text-align:center;padding-block:4rem}.hero__title{font-family:var(--font-display);font-weight:700;font-size:clamp(2rem,5vw,3.5rem);color:#fff;line-height:1.15;margin-bottom:var(--space-4)}.hero__sub{font-size:clamp(1rem,2vw,1.25rem);color:rgba(255,255,255,.88);margin-bottom:var(--space-8)}.btn{display:inline-flex;align-items:center;gap:var(--space-2);padding:var(--space-3) var(--space-6);border-radius:var(--radius-md);font-size:.9375rem;font-weight:600;cursor:pointer;border:2px solid transparent;text-decoration:none;white-space:nowrap}.btn-primary{background:var(--c-sunset-500);border-color:var(--c-sunset-500);color:#fff}.btn-lg{padding:var(--space-4) var(--space-8);font-size:1rem}.hero__ctas{display:flex;gap:var(--space-4);justify-content:center;flex-wrap:wrap}';

seo_head([
    'title'             => 'Ballonfahrten über der Schwäbischen Alb seit 1998',
    'description'       => 'Heißluftballonfahrten über der Schwäbischen Alb — Reutlingen, Tübingen, Stuttgart. Seit 1998. Registriertes Luftfahrtunternehmen, voll versichert.',
    'canonical'         => 'https://www.ballonsport-krohmer.de/',
    'og_image_key'      => 'hero_main',
    'preload_image_key' => 'hero_main',
    'critical_css'      => $criticalCss,
]);
include __DIR__ . '/../src/partials/header.php';
?>

<!-- =====================================================================
     HERO
     ===================================================================== -->
<section class="hero hero--full" aria-label="Willkommen bei Ballonsport Krohmer">
    <?= img('hero_main', 'Heißluftballon über der Schwäbischen Alb', [
        'class'    => 'hero__bg',
        'priority' => true,
        'sizes'    => '100vw',
    ]) ?>
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

<!-- =====================================================================
     REGION-BLOCK: Ballonfahrten über die Schwäbische Alb
     ===================================================================== -->
<section class="section" aria-labelledby="region-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="region-heading">Ballonfahrten über die Schwäbische Alb</h2>
            <p class="section__lead">Ihr regionaler Spezialist — von Pliezhausen aus in die Lüfte.</p>
        </div>
        <div class="prose prose--wide">
            <?= t_raw('home_region_html') ?>
        </div>
    </div>
</section>

<!-- =====================================================================
     WAS SIE ERWARTET
     ===================================================================== -->
<section class="section section--alt" aria-labelledby="erwartet-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="erwartet-heading">Was Sie erwartet</h2>
            <p class="section__lead">Von der Begrüßung bis zum Champagner — Ihr Ballon-Tag in Kürze.</p>
        </div>
        <div class="prose prose--wide">
            <?= t_raw('home_erwartet_html') ?>
        </div>
    </div>
</section>

<!-- =====================================================================
     ANLÄSSE
     ===================================================================== -->
<section class="section" aria-labelledby="anlaesse-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="anlaesse-heading">Perfekt als Geschenk für…</h2>
            <p class="section__lead">Eine Ballonfahrt ist der Geschenk-Klassiker für besondere Menschen und Momente.</p>
        </div>
        <div class="grid grid--4">
            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    </div>
                    <h3 class="card__title">Hochzeitstag</h3>
                    <p class="card__text">Romantisch, unvergesslich, besonders — eine Ballonfahrt für zwei ist das ideale Geschenk zum Hochzeitstag oder Jahrestag.</p>
                </div>
            </div>
            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <h3 class="card__title">Runder Geburtstag</h3>
                    <p class="card__text">Der 50., der 60. oder der 18. Geburtstag — ein Ballonabenteuer ist ein Erlebnisgeschenk, das lange im Gedächtnis bleibt.</p>
                </div>
            </div>
            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    </div>
                    <h3 class="card__title">Jubiläum &amp; Ruhestand</h3>
                    <p class="card__text">Ob Betriebs-Jubiläum oder Abschied in den Ruhestand — gemeinsam in die Luft gehen macht jeden Anlass zu einem besonderen Ereignis.</p>
                </div>
            </div>
            <div class="card">
                <div class="card__body">
                    <div class="card__icon">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="28" height="28"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="card__title">Für die ganze Familie</h3>
                    <p class="card__text">Kinder ab ca. 1,10 m Körpergröße können mit — entdecken Sie gemeinsam die Alb aus der Vogelperspektive.</p>
                </div>
            </div>
        </div>
        <div style="text-align:center;margin-top:var(--space-8)">
            <a href="/preise.php" class="btn btn-primary btn-lg">Gutschein anfragen</a>
        </div>
    </div>
</section>

<!-- =====================================================================
     REGIONEN-LINKS
     ===================================================================== -->
<section class="section section--alt" aria-labelledby="regionen-home-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="regionen-home-heading">Ballonfahrten in Ihrer Region</h2>
        </div>
        <div class="grid grid--3">
            <a href="/region/stuttgart.php" class="card" style="text-decoration:none;color:inherit">
                <div class="card__body">
                    <h3 class="card__title">Stuttgart &amp; Umgebung</h3>
                    <p class="card__text">Startorte im Südraum Stuttgart und über dem Kessel — mit Blick auf die Skyline und die Weinberge.</p>
                    <span class="btn btn-ghost" style="margin-top:var(--space-4)">Mehr erfahren</span>
                </div>
            </a>
            <a href="/region/reutlingen.php" class="card" style="text-decoration:none;color:inherit">
                <div class="card__body">
                    <h3 class="card__title">Reutlingen</h3>
                    <p class="card__text">Direkt am Alb-Trauf — Reutlingen ist einer unserer Haupt-Startorte mit imposanter Aussicht.</p>
                    <span class="btn btn-ghost" style="margin-top:var(--space-4)">Mehr erfahren</span>
                </div>
            </a>
            <a href="/region/tuebingen.php" class="card" style="text-decoration:none;color:inherit">
                <div class="card__body">
                    <h3 class="card__title">Tübingen</h3>
                    <p class="card__text">Über dem Neckar, dem Schloss und der historischen Altstadt — Tübingen bietet ein besonderes Ballon-Panorama.</p>
                    <span class="btn btn-ghost" style="margin-top:var(--space-4)">Mehr erfahren</span>
                </div>
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../src/partials/cta_bar.php'; ?>
<?php include __DIR__ . '/../src/partials/footer.php'; ?>
