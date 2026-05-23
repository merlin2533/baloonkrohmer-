<?php
require __DIR__ . '/../src/bootstrap.php';
seo_head([
    'title'       => t('preise_title', 'Preise'),
    'description' => t('preise_lead', 'Transparente Preise für Ballonfahrten — Erwachsene ab 235 €, Kinder ab 210 € pro Person.'),
    'canonical'   => 'https://www.ballonsport-krohmer.de/preise.php',
    'og_image_key' => 'preise_hero',
]);
include __DIR__ . '/../src/partials/header.php';
?>

<!-- =====================================================================
     PAGE HERO (kompakt)
     ===================================================================== -->
<section class="hero hero--compact" aria-label="<?= t('preise_title') ?>">
    <img
        src="<?= img_url('preise_hero') ?>"
        alt="Preise für Heißluftballonfahrten"
        class="hero__bg"
        loading="eager"
        fetchpriority="high"
    >
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <h1 class="hero__title"><?= t('preise_title') ?></h1>
        <p class="hero__sub"><?= t('preise_lead') ?></p>
    </div>
</section>

<!-- =====================================================================
     PREIS-CARDS
     ===================================================================== -->
<section class="section" aria-labelledby="preise-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="preise-heading">Unsere Tarife</h2>
            <p class="section__lead">Alle Preise verstehen sich inklusive Passagier-Haftpflicht- und Unfallversicherung.</p>
        </div>
        <div class="grid grid--3 price-grid">

            <!-- Erwachsene -->
            <div class="price-card">
                <p class="price-card__label"><?= t('preise_adult_label') ?></p>
                <p class="price-card__price"><?= t('preise_adult_price') ?></p>
                <p class="price-card__note"><?= t('preise_adult_note') ?></p>
                <div class="price-card__features">
                    <ul>
                        <li>Inkl. Versicherung</li>
                        <li>Inkl. Getränke nach Landung</li>
                        <li>Persönliche Betreuung</li>
                    </ul>
                </div>
                <a href="/kontakt.php?betreff=Termin+anfragen" class="btn btn-ghost" style="margin-top:var(--space-6);width:100%;justify-content:center">
                    Termin anfragen
                </a>
            </div>

            <!-- Kinder & Jugendliche — featured -->
            <div class="price-card price-card--featured">
                <span class="price-card__badge">Empfohlen</span>
                <p class="price-card__label"><?= t('preise_youth_label') ?></p>
                <p class="price-card__price"><?= t('preise_youth_price') ?></p>
                <p class="price-card__note"><?= t('preise_youth_note') ?></p>
                <div class="price-card__features">
                    <ul>
                        <li>Inkl. Versicherung</li>
                        <li>Inkl. Getränke nach Landung</li>
                        <li>Persönliche Betreuung</li>
                    </ul>
                </div>
                <a href="/kontakt.php?betreff=Termin+anfragen" class="btn btn-primary" style="margin-top:var(--space-6);width:100%;justify-content:center">
                    Termin anfragen
                </a>
            </div>

            <!-- Gruppen -->
            <div class="price-card">
                <p class="price-card__label"><?= t('preise_group_label') ?></p>
                <p class="price-card__price"><?= t('preise_group_price') ?></p>
                <p class="price-card__note">individuelle Berechnung</p>
                <div class="price-card__features">
                    <ul>
                        <li>Bis zu 25 Passagiere</li>
                        <li>Mehrere Ballone möglich</li>
                        <li>Rahmenprogramm buchbar</li>
                    </ul>
                </div>
                <a href="/kontakt.php?betreff=Gruppenfahrt" class="btn btn-ghost" style="margin-top:var(--space-6);width:100%;justify-content:center">
                    Angebot anfordern
                </a>
            </div>

        </div>
    </div>
</section>

<!-- =====================================================================
     VOUCHER-SEKTION
     ===================================================================== -->
<section class="section section--alt" aria-labelledby="voucher-heading">
    <div class="container">
        <div class="voucher-section">
            <div class="voucher-section__icon">
                <svg aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48" style="color:var(--c-sunset-500)">
                    <path d="M20 12V22H4V12"/>
                    <path d="M22 7H2v5h20V7z"/>
                    <path d="M12 22V7"/>
                    <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/>
                    <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/>
                </svg>
            </div>
            <div class="voucher-section__content">
                <h2 class="section__title" id="voucher-heading">Geschenkgutscheine</h2>
                <div class="prose">
                    <?= t_raw('preise_voucher_html') ?>
                </div>
                <a href="/kontakt.php?betreff=Gutschein" class="btn btn-primary" style="margin-top:var(--space-5)">
                    Gutschein anfragen
                </a>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================================
     VERSICHERUNGSHINWEIS
     ===================================================================== -->
<section class="section" aria-label="Versicherungshinweis">
    <div class="container">
        <div class="alert alert--info" style="max-width:720px;margin-inline:auto">
            <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" width="20" height="20" style="float:left;margin-right:var(--space-3);margin-top:2px;flex-shrink:0;color:var(--c-sky-700)">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <?= t_raw('preise_insurance_html') ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../src/partials/cta_bar.php'; ?>
<?php include __DIR__ . '/../src/partials/footer.php'; ?>
