<?php
require __DIR__ . '/../src/bootstrap.php';
seo_head([
    'title'       => t('faq_title', 'Häufig gestellte Fragen'),
    'description' => t('faq_lead', 'Antworten auf die wichtigsten Fragen rund um Ihre Ballonfahrt mit Ballonsport Krohmer.'),
    'canonical'   => 'https://www.ballonsport-krohmer.de/faq.php',
    'og_image_key' => 'og_default',
]);
include __DIR__ . '/../src/partials/header.php';
?>

<!-- =====================================================================
     PAGE HERO (kompakt)
     ===================================================================== -->
<section class="hero hero--compact" aria-label="<?= t('faq_title') ?>">
    <div class="hero__overlay" style="background:linear-gradient(135deg,rgba(11,23,38,.7) 0%,rgba(30,58,95,.5) 100%)"></div>
    <div class="container hero__inner">
        <h1 class="hero__title"><?= t('faq_title') ?></h1>
        <p class="hero__sub"><?= t('faq_lead') ?></p>
    </div>
</section>

<!-- =====================================================================
     FAQ ACCORDION
     ===================================================================== -->
<section class="section" aria-labelledby="faq-acc-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title sr-only" id="faq-acc-heading">Fragen &amp; Antworten</h2>
        </div>
        <div class="faq">

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q1') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a1_html') ?></div>
            </details>

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q2') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a2_html') ?></div>
            </details>

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q3') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a3_html') ?></div>
            </details>

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q4') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a4_html') ?></div>
            </details>

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q5') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a5_html') ?></div>
            </details>

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q6') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a6_html') ?></div>
            </details>

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q7') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a7_html') ?></div>
            </details>

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q8') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a8_html') ?></div>
            </details>

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q9') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a9_html') ?></div>
            </details>

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q10') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a10_html') ?></div>
            </details>

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q11') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a11_html') ?></div>
            </details>

            <details class="faq__item">
                <summary class="faq__q"><?= t('faq_q12') ?></summary>
                <div class="faq__a"><?= t_raw('faq_a12_html') ?></div>
            </details>

        </div>
    </div>
</section>

<?php include __DIR__ . '/../src/partials/cta_bar.php'; ?>
<?php include __DIR__ . '/../src/partials/footer.php'; ?>
