<?php
/**
 * Ballonsport Krohmer — Admin Layout Top
 * Erwartet: $page_title (string)
 */
// Sicherstellen dass page_title gesetzt ist
$page_title = $page_title ?? 'Admin';

// Aktive Seite für Nav ermitteln
$current_script = basename($_SERVER['SCRIPT_FILENAME'] ?? '');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title><?= e($page_title) ?> — Admin | Ballonsport Krohmer</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
<div class="a-shell">
    <header class="a-topbar">
        <a href="/admin/" class="a-topbar__brand">Ballonsport Krohmer — Admin</a>
        <div class="a-topbar__right">
            <span>Eingeloggt</span>
            <a href="/admin/logout.php" class="a-topbar__logout">Abmelden</a>
        </div>
    </header>

    <!-- Mobile Navigation -->
    <nav class="a-mobile-nav" aria-label="Admin-Navigation Mobile">
        <a href="/admin/" class="<?= $current_script === 'index.php' ? 'a-active' : '' ?>">Dashboard</a>
        <a href="/admin/content.php" class="<?= $current_script === 'content.php' ? 'a-active' : '' ?>">Texte</a>
        <a href="/admin/images.php" class="<?= $current_script === 'images.php' ? 'a-active' : '' ?>">Bilder</a>
        <a href="/" target="_blank" rel="noopener">Webseite ↗</a>
    </nav>

    <div class="a-body">
        <aside class="a-sidebar">
            <div class="a-sidebar__label">Navigation</div>
            <nav aria-label="Admin-Navigation">
                <a href="/admin/" class="<?= $current_script === 'index.php' ? 'a-active' : '' ?>">
                    📊 Dashboard
                </a>
                <a href="/admin/content.php" class="<?= $current_script === 'content.php' ? 'a-active' : '' ?>">
                    📝 Texte bearbeiten
                </a>
                <a href="/admin/images.php" class="<?= $current_script === 'images.php' ? 'a-active' : '' ?>">
                    🖼️ Bilder verwalten
                </a>
            </nav>
            <div class="a-sidebar__label">Links</div>
            <nav aria-label="Externe Links">
                <a href="/" target="_blank" rel="noopener">🌐 Zur Webseite ↗</a>
            </nav>
        </aside>

        <main class="a-main">
