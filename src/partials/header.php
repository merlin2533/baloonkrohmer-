<?php
/**
 * Ballonsport Krohmer — Sticky Header
 *
 * Erwartet: $current (optional, Dateiname der aktuellen Seite)
 */
$current = $current ?? basename($_SERVER['PHP_SELF'] ?? 'index.php');
?>
</head>
<body>

<a class="skip-link" href="#main-content">Zum Hauptinhalt springen</a>

<header class="header" id="site-header">
    <div class="header__inner container">

        <!-- Logo -->
        <a href="/" class="header__logo" aria-label="Ballonsport Krohmer — Startseite">
            <?= img('logo', 'Ballonsport Krohmer', ['class' => 'header__logo-img', 'width' => '180', 'height' => '48']) ?>
        </a>

        <!-- Hauptnavigation (Desktop) -->
        <?php include __DIR__ . '/nav.php'; ?>

        <!-- Telefon-CTA (Desktop) -->
        <a href="tel:+49712721173" class="btn btn-primary header__cta" aria-label="Jetzt anrufen">
            <svg class="icon" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
            </svg>
            <span class="header__cta-label">07127 / 21173</span>
        </a>

        <!-- Hamburger (Mobil) -->
        <button class="header__hamburger" id="hamburger-btn"
                aria-expanded="false"
                aria-controls="mobile-menu"
                aria-label="Menü öffnen">
            <span class="hamburger__line"></span>
            <span class="hamburger__line"></span>
            <span class="hamburger__line"></span>
        </button>

    </div>

    <!-- Mobiles Menü -->
    <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
        <div class="container">
            <?php include __DIR__ . '/nav.php'; ?>
            <a href="tel:+49712721173" class="btn btn-primary btn-lg mobile-menu__cta">
                Jetzt anrufen: 07127 / 21173
            </a>
        </div>
    </div>
</header>

<main id="main-content">
