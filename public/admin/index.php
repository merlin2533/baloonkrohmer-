<?php
/**
 * Ballonsport Krohmer — Admin Dashboard
 */
declare(strict_types=1);

define('ROOT', dirname(__DIR__, 2));
require_once ROOT . '/src/bootstrap.php';

require_admin();

// Statistiken zusammenstellen
$contentKeys = all_content_keys();
$imageKeys   = all_image_keys();

$contentCount = count($contentKeys);
$imageCount   = count($imageKeys);

// Letzte Änderung aus beiden Tabellen
$lastChanged = null;
try {
    $row = db()->query(
        "SELECT MAX(updated_at) AS last FROM (
            SELECT updated_at FROM content
            UNION ALL
            SELECT updated_at FROM images
         )"
    )->fetch();
    if ($row && $row['last']) {
        $lastChanged = date('d.m.Y H:i', (int) $row['last']);
    }
} catch (Exception $e) {
    $lastChanged = null;
}

$page_title = 'Dashboard';
require ROOT . '/src/partials/admin_layout_top.php';
?>

<div class="a-page-header">
    <h1>Hallo! Was möchtest Du tun?</h1>
</div>

<div class="a-action-grid">
    <a href="/admin/content.php" class="a-action-card">
        <span class="a-action-card__icon">📝</span>
        <div class="a-action-card__title">Texte bearbeiten</div>
        <div class="a-action-card__sub">Überschriften, Beschreibungen, FAQ-Antworten</div>
    </a>

    <a href="/admin/images.php" class="a-action-card">
        <span class="a-action-card__icon">🖼️</span>
        <div class="a-action-card__title">Bilder verwalten</div>
        <div class="a-action-card__sub">Hero-Bilder, Galerie, Logos</div>
    </a>

    <a href="/" target="_blank" rel="noopener" class="a-action-card">
        <span class="a-action-card__icon">🌐</span>
        <div class="a-action-card__title">Webseite ansehen</div>
        <div class="a-action-card__sub">Live-Vorschau in neuem Tab</div>
    </a>
</div>

<div class="a-stats">
    <div class="a-stat">
        <span class="a-stat__value"><?= e((string) $contentCount) ?></span>
        <span class="a-stat__label">Texte verwaltet</span>
    </div>
    <div class="a-stat">
        <span class="a-stat__value"><?= e((string) $imageCount) ?></span>
        <span class="a-stat__label">Bilder verwaltet</span>
    </div>
    <div class="a-stat">
        <span class="a-stat__value"><?= $lastChanged !== null ? e($lastChanged) : '—' ?></span>
        <span class="a-stat__label">Letzte Änderung</span>
    </div>
</div>

<?php require ROOT . '/src/partials/admin_layout_bottom.php'; ?>
