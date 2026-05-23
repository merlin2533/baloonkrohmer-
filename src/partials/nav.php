<?php
/**
 * Ballonsport Krohmer — Navigationspunkte
 *
 * $current wird in header.php gesetzt und hebt die aktive Seite hervor.
 */

$navItems = [
    ['href' => '/',               'label' => 'Start',        'file' => 'index.php'],
    ['href' => '/ballonfahren.php', 'label' => 'Ballonfahren', 'file' => 'ballonfahren.php'],
    ['href' => '/unsere-ballone.php', 'label' => 'Unsere Ballone', 'file' => 'unsere-ballone.php'],
    ['href' => '/preise.php',     'label' => 'Preise',        'file' => 'preise.php'],
    ['href' => '/galerie.php',    'label' => 'Galerie',       'file' => 'galerie.php'],
    ['href' => '/faq.php',        'label' => 'FAQ',           'file' => 'faq.php'],
    ['href' => '/kontakt.php',    'label' => 'Kontakt',       'file' => 'kontakt.php'],
];

$current = $current ?? basename($_SERVER['PHP_SELF'] ?? 'index.php');
?>
<nav class="nav" aria-label="Hauptnavigation">
    <ul class="nav__list" role="list">
        <?php foreach ($navItems as $item): ?>
            <?php
            $isActive = ($current === $item['file'])
                || ($current === 'index.php' && $item['file'] === 'index.php');
            $linkClass = 'nav__link' . ($isActive ? ' nav__link--active' : '');
            $ariaCurrent = $isActive ? ' aria-current="page"' : '';
            ?>
            <li class="nav__item">
                <a href="<?= e($item['href']) ?>"
                   class="<?= e($linkClass) ?>"
                   <?= $ariaCurrent ?>><?= e($item['label']) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
