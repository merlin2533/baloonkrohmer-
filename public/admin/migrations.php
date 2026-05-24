<?php
/**
 * Ballonsport Krohmer — Admin: Migration-Status
 *
 * Zeigt welche Auto-Migrations bereits angewendet wurden, welche noch
 * ausstehen, und erlaubt das manuelle erneute Anstoßen aller pending
 * Migrations (defensiver Fallback, falls Auto-Apply blockiert war).
 */
declare(strict_types=1);

define('ROOT', dirname(__DIR__, 2));
require_once ROOT . '/src/bootstrap.php';

require_admin();

// POST-Handler: pending Migrations erneut anstoßen
$justRan = [];
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    if (!csrf_check($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        exit('CSRF check failed');
    }
    @unlink(ROOT . '/data/.migration.lock');
    $justRan = apply_pending_migrations();
}

$applied   = list_applied_migrations();
$available = list_available_migrations();
$appliedIds = array_flip(array_column($applied, 'id'));
$pending   = array_values(array_filter($available, fn($id) => !isset($appliedIds[$id])));

$page_title = 'Migrationen';
require ROOT . '/src/partials/admin_layout_top.php';
?>

<div class="a-page-header">
    <h1>Migrationen</h1>
    <p>Automatisch eingespielte Code-Updates (Texte, Schema-Änderungen). Jede Migration läuft genau einmal.</p>
</div>

<?php if ($justRan): ?>
    <div class="a-banner a-banner--success">
        <strong><?= count($justRan) ?> Migration(en) gerade angewendet:</strong>
        <?= e(implode(', ', $justRan)) ?>
    </div>
<?php endif; ?>

<section class="a-card">
    <h2 class="a-card__title">Status</h2>
    <div class="a-card__body">
        <p>
            Angewendet: <strong><?= count($applied) ?></strong> /
            Verfügbar: <strong><?= count($available) ?></strong>
            <?php if (count($pending) > 0): ?>
                — <span style="color: var(--a-error)">⚠ <?= count($pending) ?> ausstehend</span>
            <?php else: ?>
                — <span style="color: var(--a-success)">✓ alle aktuell</span>
            <?php endif; ?>
        </p>
        <?php if (count($pending) > 0): ?>
            <form method="post" style="margin-top: 1rem">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <button type="submit" class="a-btn a-btn--primary">Pending Migrations jetzt anwenden</button>
            </form>
        <?php endif; ?>
    </div>
</section>

<section class="a-card" style="margin-top: 1.5rem">
    <h2 class="a-card__title">Angewendet</h2>
    <div class="a-card__body">
        <?php if (count($applied) === 0): ?>
            <p>Noch keine Migrations angewendet.</p>
        <?php else: ?>
            <table class="a-table" style="width:100%; border-collapse: collapse">
                <thead>
                    <tr style="border-bottom: 1px solid var(--a-line)">
                        <th style="text-align:left; padding: 0.5rem 0.75rem">ID</th>
                        <th style="text-align:left; padding: 0.5rem 0.75rem">Angewendet am</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($applied as $row): ?>
                        <tr style="border-bottom: 1px solid var(--a-line)">
                            <td style="padding: 0.5rem 0.75rem; font-family: monospace; font-size: 0.875rem"><?= e($row['id']) ?></td>
                            <td style="padding: 0.5rem 0.75rem"><?= e(date('d.m.Y H:i', (int) $row['applied_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>

<?php if (count($pending) > 0): ?>
<section class="a-card" style="margin-top: 1.5rem">
    <h2 class="a-card__title">Ausstehend</h2>
    <div class="a-card__body">
        <ul>
            <?php foreach ($pending as $id): ?>
                <li style="font-family: monospace; font-size: 0.875rem"><?= e($id) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<?php endif; ?>

<section class="a-card" style="margin-top: 1.5rem">
    <h2 class="a-card__title">Wie funktioniert das?</h2>
    <div class="a-card__body">
        <p>
            Jede Code-Aktualisierung kann neue Migrations mitliefern (z. B. Text-Anpassungen
            oder neue Inhalts-Blöcke). Diese werden beim ersten Seitenaufruf nach dem Deployment
            automatisch eingespielt. Manuelle Eingaben sind nicht nötig.
        </p>
        <p>
            <strong>Wichtig:</strong> Eine Migration läuft genau <strong>einmal</strong> pro
            Installation. Deine späteren Änderungen über
            <a href="/admin/content.php">Texte bearbeiten</a> bleiben erhalten.
        </p>
        <p>
            Falls eine Migration ausstehend bleibt (z. B. wegen eines vorherigen Fehlers), kannst
            Du sie hier manuell auslösen.
        </p>
    </div>
</section>

<?php require ROOT . '/src/partials/admin_layout_bottom.php'; ?>
