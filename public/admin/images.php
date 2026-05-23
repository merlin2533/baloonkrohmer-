<?php
/**
 * Ballonsport Krohmer — Admin: Bilder verwalten
 */
declare(strict_types=1);

define('ROOT', dirname(__DIR__, 2));
require_once ROOT . '/src/bootstrap.php';

require_admin();

// Alle Image-Keys laden
$imageKeys = all_image_keys();

// Aktuelle Bild-Infos aus DB laden
$imageData = [];
foreach ($imageKeys as $key) {
    $stmt = db()->prepare('SELECT filename, alt FROM images WHERE key = :key');
    $stmt->execute([':key' => $key]);
    $row = $stmt->fetch();
    $imageData[$key] = $row ?: ['filename' => '', 'alt' => ''];
}

$uploadedKey = isset($_GET['uploaded']) ? (string) $_GET['uploaded'] : '';

$page_title = 'Bilder verwalten';
require ROOT . '/src/partials/admin_layout_top.php';
?>

<div class="a-page-header">
    <h1>Bilder verwalten</h1>
    <p>Wähle für jedes Bild eine neue Datei aus (JPEG, PNG oder WebP, max. 5 MB).</p>
</div>

<?php if ($uploadedKey !== ''): ?>
    <div class="a-banner a-banner--success" role="status">
        Bild „<?= e($uploadedKey) ?>" wurde erfolgreich hochgeladen.
    </div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="a-banner a-banner--error" role="alert">
        Fehler: <?= e($_GET['error']) ?>
    </div>
<?php endif; ?>

<?php if (empty($imageKeys)): ?>
    <div class="a-banner a-banner--error">
        Keine Bild-Keys gefunden. Bitte zuerst die Datenbank initialisieren.
    </div>
<?php else: ?>
<div class="a-grid--images">
    <?php foreach ($imageKeys as $key): ?>
    <?php
        $data   = $imageData[$key];
        $altVal = $data['alt'] ?? '';
        $imgUrl = img_url($key);
    ?>
    <div class="a-img-card">
        <div class="a-img-card__preview">
            <img
                src="<?= e($imgUrl) ?>"
                alt="<?= e($altVal ?: $key) ?>"
                class="a-thumb"
                loading="lazy"
            >
        </div>

        <div class="a-img-card__body">
            <div class="a-img-key"><?= e($key) ?></div>

            <?php if ($altVal !== ''): ?>
                <div class="a-img-alt"><?= e($altVal) ?></div>
            <?php endif; ?>

            <form
                class="a-img-form"
                action="/admin/upload.php"
                method="post"
                enctype="multipart/form-data"
            >
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <input type="hidden" name="key" value="<?= e($key) ?>">

                <div class="a-field a-mb-0">
                    <label class="a-label" for="img-<?= e($key) ?>">Neue Datei</label>
                    <input
                        class="a-input a-input--file"
                        type="file"
                        id="img-<?= e($key) ?>"
                        name="image"
                        accept="image/jpeg,image/png,image/webp"
                        required
                    >
                </div>

                <div class="a-field a-mb-0">
                    <label class="a-label a-label--muted" for="alt-<?= e($key) ?>">Alt-Text</label>
                    <input
                        class="a-input"
                        type="text"
                        id="alt-<?= e($key) ?>"
                        name="alt"
                        value="<?= e($altVal) ?>"
                        placeholder="Bildbeschreibung für Suchmaschinen & Barrierefreiheit"
                    >
                </div>

                <button type="submit" class="a-btn a-btn--primary a-btn--sm">
                    Ersetzen
                </button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php require ROOT . '/src/partials/admin_layout_bottom.php'; ?>
