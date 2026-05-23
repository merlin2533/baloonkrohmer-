<?php
require __DIR__ . '/../src/bootstrap.php';
seo_head([
    'title'       => t('galerie_title', 'Bildergalerie'),
    'description' => t('galerie_lead', 'Eindrücke aus über zwei Jahrzehnten Ballonfahren über der Schwäbischen Alb.'),
    'canonical'   => 'https://www.ballonsport-krohmer.de/galerie.php',
    'og_image_key' => 'gallery_01',
]);
include __DIR__ . '/../src/partials/header.php';
?>

<!-- =====================================================================
     PAGE HERO (kompakt)
     ===================================================================== -->
<section class="hero hero--compact" aria-label="<?= t('galerie_title') ?>">
    <div class="hero__overlay" style="background:linear-gradient(135deg,rgba(11,23,38,.7) 0%,rgba(30,58,95,.5) 100%)"></div>
    <div class="container hero__inner">
        <h1 class="hero__title"><?= t('galerie_title') ?></h1>
        <p class="hero__sub"><?= t('galerie_lead') ?></p>
    </div>
</section>

<!-- =====================================================================
     GALERIE-GRID
     ===================================================================== -->
<section class="section" aria-labelledby="galerie-heading">
    <div class="container">
        <div class="gallery" role="list">
<?php for ($i = 1; $i <= 15; $i++):
    $key    = sprintf('gallery_%02d', $i);
    $src    = img_url($key);
    $stmt   = db()->prepare('SELECT alt FROM images WHERE key = :key');
    $stmt->execute([':key' => $key]);
    $dbRow  = $stmt->fetch();
    $alt    = $dbRow ? e($dbRow['alt']) : 'Eindruck einer Ballonfahrt';
?>
            <button
                class="gallery__item"
                role="listitem"
                data-lightbox-src="<?= e($src) ?>"
                data-lightbox-alt="<?= $alt ?>"
                aria-label="Bild <?= $i ?> vergrößern: <?= $alt ?>"
            >
                <?= img($key, $dbRow['alt'] ?? 'Eindruck einer Ballonfahrt', [
                    'class'   => 'gallery__img',
                    'loading' => 'lazy',
                    'sizes'   => '(max-width: 640px) 50vw, (max-width: 1100px) 33vw, 400px',
                ]) ?>
            </button>
<?php endfor; ?>
        </div>
    </div>
</section>

<!-- Lightbox-Overlay -->
<div class="lightbox" id="lightbox" aria-modal="true" role="dialog" aria-label="Bildansicht" aria-hidden="true">
    <button class="lightbox__close" id="lightbox-close" aria-label="Bild schließen">&times;</button>
    <button class="lightbox__prev" id="lightbox-prev" aria-label="Vorheriges Bild">&#8592;</button>
    <img class="lightbox__img" id="lightbox-img" src="" alt="">
    <button class="lightbox__next" id="lightbox-next" aria-label="Nächstes Bild">&#8594;</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
(function () {
    'use strict';
    var items   = Array.from(document.querySelectorAll('.gallery__item[data-lightbox-src]'));
    var lb      = document.getElementById('lightbox');
    var lbImg   = document.getElementById('lightbox-img');
    var lbClose = document.getElementById('lightbox-close');
    var lbPrev  = document.getElementById('lightbox-prev');
    var lbNext  = document.getElementById('lightbox-next');
    var current = 0;

    if (!lb || !items.length) return;

    function open(index) {
        current = (index + items.length) % items.length;
        var item = items[current];
        lbImg.src = item.dataset.lightboxSrc || '';
        lbImg.alt = item.dataset.lightboxAlt || '';
        lb.classList.add('is-open');
        lb.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        lbClose.focus();
    }

    function close() {
        lb.classList.remove('is-open');
        lb.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        if (items[current]) items[current].focus();
    }

    items.forEach(function (item, i) {
        item.addEventListener('click', function () { open(i); });
    });

    lbClose.addEventListener('click', close);
    lbPrev.addEventListener('click', function () { open(current - 1); });
    lbNext.addEventListener('click', function () { open(current + 1); });

    lb.addEventListener('click', function (e) {
        if (e.target === lb) close();
    });

    document.addEventListener('keydown', function (e) {
        if (!lb.classList.contains('is-open')) return;
        if (e.key === 'Escape')      close();
        if (e.key === 'ArrowLeft')   open(current - 1);
        if (e.key === 'ArrowRight')  open(current + 1);
    });
}());
}); // DOMContentLoaded
</script>

<?php include __DIR__ . '/../src/partials/footer.php'; ?>
