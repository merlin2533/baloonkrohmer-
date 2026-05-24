<?php
/**
 * Ballonsport Krohmer — Breadcrumb-Komponente
 *
 * Erwartet: $breadcrumbs (array) — Array von ['name' => '...', 'url' => '...']
 * Letztes Element ist die aktuelle Seite (kein Link).
 *
 * Beispiel:
 *   $breadcrumbs = [
 *       ['name' => 'Start', 'url' => '/'],
 *       ['name' => 'Ballonfahren', 'url' => '/ballonfahren.php'],
 *   ];
 *   include __DIR__ . '/../src/partials/breadcrumbs.php';
 */

if (empty($breadcrumbs) || !is_array($breadcrumbs)) {
    return;
}
?>
<nav class="breadcrumbs" aria-label="Brotkrümelnavigation">
    <div class="container">
        <ol class="breadcrumbs__list"
            itemscope
            itemtype="https://schema.org/BreadcrumbList">
            <?php foreach ($breadcrumbs as $i => $crumb):
                $isLast = ($i === count($breadcrumbs) - 1);
                $pos    = $i + 1;
            ?>
            <li class="breadcrumbs__item"
                itemprop="itemListElement"
                itemscope
                itemtype="https://schema.org/ListItem">
                <?php if (!$isLast): ?>
                    <a class="breadcrumbs__link"
                       href="<?= e($crumb['url']) ?>"
                       itemprop="item">
                        <span itemprop="name"><?= e($crumb['name']) ?></span>
                    </a>
                    <span class="breadcrumbs__sep" aria-hidden="true">›</span>
                <?php else: ?>
                    <span class="breadcrumbs__current"
                          itemprop="item"
                          itemscope
                          itemtype="https://schema.org/WebPage">
                        <span itemprop="name"><?= e($crumb['name']) ?></span>
                    </span>
                <?php endif; ?>
                <meta itemprop="position" content="<?= $pos ?>">
            </li>
            <?php endforeach; ?>
        </ol>
    </div>
</nav>
