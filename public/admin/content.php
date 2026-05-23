<?php
/**
 * Ballonsport Krohmer — Admin: Texte bearbeiten
 */
declare(strict_types=1);

define('ROOT', dirname(__DIR__, 2));
require_once ROOT . '/src/bootstrap.php';

require_admin();

// Alle Content-Keys laden
$allKeys = all_content_keys(); // gibt string[] zurück

// Keys nach Bereich gruppieren (Prefix vor erstem Unterstrich)
$groups = [];
foreach ($allKeys as $key) {
    $pos    = strpos($key, '_');
    $prefix = $pos !== false ? substr($key, 0, $pos) : $key;
    $groups[$prefix][] = $key;
}
ksort($groups);

// Bekannte Prefix-Labels
$prefixLabels = [
    'ballonfahren' => 'Ballonfahren',
    'ballone'      => 'Ballone',
    'ballon'       => 'Ballone',
    'datenschutz'  => 'Datenschutz',
    'faq'          => 'FAQ',
    'galerie'      => 'Galerie',
    'hero'         => 'Hero',
    'home'         => 'Home',
    'impressum'    => 'Impressum',
    'kontakt'      => 'Kontakt',
    'preise'       => 'Preise',
    'usp'          => 'USPs',
];

// Werte aus der DB laden (t_raw für alle, da wir im Admin rohen Inhalt zeigen)
$values = [];
foreach ($allKeys as $key) {
    $stmt = db()->prepare('SELECT value FROM content WHERE key = :key');
    $stmt->execute([':key' => $key]);
    $row = $stmt->fetch();
    $values[$key] = $row !== false ? $row['value'] : '';
}

$page_title = 'Texte bearbeiten';
require ROOT . '/src/partials/admin_layout_top.php';
?>

<div class="a-page-header">
    <h1>Texte bearbeiten</h1>
    <p>Klicke einen Bereich auf, bearbeite die Felder und speichere mit dem Button am Ende des Bereichs.</p>
</div>

<?php if (isset($_GET['saved']) && $_GET['saved'] === '1'): ?>
    <div class="a-banner a-banner--success" role="status">
        Änderungen wurden gespeichert.
    </div>
<?php elseif (isset($_GET['error'])): ?>
    <div class="a-banner a-banner--error" role="alert">
        Fehler: <?= e($_GET['error']) ?>
    </div>
<?php endif; ?>

<?php foreach ($groups as $prefix => $keys): ?>
<?php
    $sectionLabel = $prefixLabels[$prefix] ?? ucfirst($prefix);
    $sectionId    = 'section-' . e($prefix);
    // Prüfen ob dieser Bereich im GET-Param als zuletzt gespeichert markiert ist
    $isOpen = isset($_GET['section']) && $_GET['section'] === $prefix;
?>
<div class="a-section" id="<?= e($sectionId) ?>">
    <button
        type="button"
        class="a-section__toggle"
        aria-expanded="<?= $isOpen ? 'true' : 'false' ?>"
        aria-controls="body-<?= e($prefix) ?>"
        data-section="<?= e($prefix) ?>"
    >
        <span>
            <?= e($sectionLabel) ?>
            <span class="a-section__count">(<?= count($keys) ?> <?= count($keys) === 1 ? 'Feld' : 'Felder' ?>)</span>
        </span>
        <span class="a-section__arrow">▼</span>
    </button>

    <div
        class="a-section__body<?= $isOpen ? ' a-open' : '' ?>"
        id="body-<?= e($prefix) ?>"
    >
        <form method="post" action="/admin/save-content.php">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <input type="hidden" name="_section" value="<?= e($prefix) ?>">

            <?php foreach ($keys as $key): ?>
            <div class="a-key-item">
                <div class="a-key-name"><?= e($key) ?></div>
                <?php if (str_ends_with($key, '_html')): ?>
                    <textarea
                        class="a-textarea"
                        name="<?= e($key) ?>"
                        rows="6"
                        aria-label="<?= e($key) ?>"
                    ><?= htmlspecialchars($values[$key] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></textarea>
                <?php else: ?>
                    <input
                        class="a-input"
                        type="text"
                        name="<?= e($key) ?>"
                        value="<?= e($values[$key] ?? '') ?>"
                        aria-label="<?= e($key) ?>"
                    >
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

            <div class="a-section-actions">
                <button type="submit" class="a-btn a-btn--primary">
                    Bereich „<?= e($sectionLabel) ?>" speichern
                </button>
            </div>
        </form>
    </div>
</div>
<?php endforeach; ?>

<script>
// Einfaches Akkordeon
document.querySelectorAll('.a-section__toggle').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var expanded = this.getAttribute('aria-expanded') === 'true';
        var bodyId   = this.getAttribute('aria-controls');
        var body     = document.getElementById(bodyId);
        if (!body) return;

        this.setAttribute('aria-expanded', String(!expanded));
        body.classList.toggle('a-open', !expanded);
    });
});
</script>

<?php require ROOT . '/src/partials/admin_layout_bottom.php'; ?>
