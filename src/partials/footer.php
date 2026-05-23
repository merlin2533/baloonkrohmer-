<?php
/**
 * Ballonsport Krohmer — Footer
 */
?>
</main>

<footer class="footer">
    <div class="footer__inner container">
        <div class="footer__cols">

            <!-- Spalte 1: Logo + Tagline -->
            <div class="footer__col footer__col--brand">
                <a href="/" class="footer__logo-link" aria-label="Ballonsport Krohmer — Startseite">
                    <?= img('logo', 'Ballonsport Krohmer', ['class' => 'footer__logo', 'width' => '160', 'height' => '42']) ?>
                </a>
                <p class="footer__tagline">Ballonfahrten über der Schwäbischen Alb seit 1998.</p>
            </div>

            <!-- Spalte 2: Kontakt + Adresse -->
            <div class="footer__col">
                <h3 class="footer__heading">Kontakt</h3>
                <address class="footer__address">
                    <strong><?= t('kontakt_company') ?></strong><br>
                    <?= t('kontakt_owner') ?><br>
                    <?= t('kontakt_street') ?><br>
                    <?= t('kontakt_zip_city') ?>
                </address>
                <ul class="footer__contact-list">
                    <li>
                        <a href="tel:+49712721173" class="footer__link">
                            Tel: <?= t('kontakt_phone_display') ?>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?= t('kontakt_email_display') ?>" class="footer__link">
                            <?= t('kontakt_email_display') ?>
                        </a>
                    </li>
                </ul>
                <?= t_raw('kontakt_hours_html') ?>
            </div>

            <!-- Spalte 3: Navigation -->
            <div class="footer__col">
                <h3 class="footer__heading">Angebot</h3>
                <ul class="footer__nav-list">
                    <li><a href="/ballonfahren.php" class="footer__link">Ballonfahren</a></li>
                    <li><a href="/unsere-ballone.php" class="footer__link">Unsere Ballone</a></li>
                    <li><a href="/preise.php" class="footer__link">Preise</a></li>
                    <li><a href="/galerie.php" class="footer__link">Galerie</a></li>
                    <li><a href="/faq.php" class="footer__link">FAQ</a></li>
                    <li><a href="/kontakt.php" class="footer__link">Kontakt</a></li>
                </ul>
            </div>

            <!-- Spalte 4: Rechtliches -->
            <div class="footer__col">
                <h3 class="footer__heading">Rechtliches</h3>
                <ul class="footer__nav-list">
                    <li><a href="/impressum.php" class="footer__link">Impressum</a></li>
                    <li><a href="/datenschutz.php" class="footer__link">Datenschutz</a></li>
                </ul>
            </div>

        </div><!-- /.footer__cols -->

        <div class="footer__bottom">
            <p class="footer__copyright">
                &copy; <?= date('Y') ?> Ballonsport Krohmer — Alle Rechte vorbehalten.
            </p>
        </div>

    </div><!-- /.footer__inner -->
</footer>

<!-- Sticky Mobile CTA (nur sichtbar auf mobilen Geräten) -->
<div class="sticky-cta" aria-label="Schnellkontakt">
    <a href="tel:+49712721173" class="sticky-cta__btn sticky-cta__btn--call">
        <svg class="icon" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" width="20" height="20">
            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
        </svg>
        Anrufen
    </a>
    <a href="/kontakt.php" class="sticky-cta__btn sticky-cta__btn--contact">
        <svg class="icon" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" width="20" height="20">
            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
        </svg>
        Anfragen
    </a>
</div>

<script defer src="<?= e(asset('/assets/js/main.js')) ?>"></script>
</body>
</html>
