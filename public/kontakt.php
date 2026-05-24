<?php
require __DIR__ . '/../src/bootstrap.php';

// -------------------------------------------------------------------------
// POST-HANDLING
// -------------------------------------------------------------------------
$errors     = [];
$formSent   = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF-Prüfung
    if (!csrf_check($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Sicherheitsprüfung fehlgeschlagen. Bitte laden Sie die Seite neu und versuchen Sie es erneut.';
    }

    // Honeypot-Check: Feld "website" muss leer sein
    if (!empty($_POST['website'])) {
        // Bot — still zu danke.php weiterleiten
        header('Location: /danke.php');
        exit;
    }

    if (empty($errors)) {
        // Felder einlesen und bereinigen
        $name       = trim($_POST['name'] ?? '');
        $email      = trim($_POST['email'] ?? '');
        $telefon    = trim($_POST['telefon'] ?? '');
        $betreff    = trim($_POST['betreff'] ?? '');
        $nachricht  = trim($_POST['nachricht'] ?? '');
        $datenschutz = !empty($_POST['datenschutz']);

        // Validierung
        if ($name === '') {
            $errors[] = 'Bitte geben Sie Ihren Namen an.';
        }
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
        }
        if ($nachricht === '') {
            $errors[] = 'Bitte geben Sie eine Nachricht ein.';
        }
        if (!$datenschutz) {
            $errors[] = 'Bitte stimmen Sie der Datenschutzerklärung zu.';
        }

        // Bei keinen Fehlern: E-Mail senden
        if (empty($errors)) {
            $to          = 'info@ballonsport-krohmer.de';
            $subject     = '[Kontaktformular] ' . ($betreff !== '' ? $betreff : 'Allgemeine Anfrage');
            $body        = "Name: {$name}\n"
                         . "E-Mail: {$email}\n"
                         . ($telefon !== '' ? "Telefon: {$telefon}\n" : '')
                         . "Betreff: {$betreff}\n\n"
                         . "Nachricht:\n{$nachricht}\n";
            $headers     = "From: noreply@ballonsport-krohmer.de\r\n"
                         . "Reply-To: {$email}\r\n"
                         . "X-Mailer: PHP/" . phpversion();

            $sent = @mail($to, $subject, $body, $headers);
            if (!$sent) {
                error_log('Kontaktformular: mail() fehlgeschlagen für ' . $email);
            }

            // PRG-Pattern: immer zu danke.php weiterleiten
            header('Location: /danke.php');
            exit;
        }
    }
}

// Betreff aus GET vorbelegen (z.B. /kontakt.php?betreff=gutschein)
$getBetreff = htmlspecialchars_decode(trim($_GET['betreff'] ?? ''), ENT_QUOTES);

$allowedBetreff = ['Allgemeine Anfrage', 'Termin anfragen', 'Gutschein', 'Gruppenfahrt'];
if (!in_array($getBetreff, $allowedBetreff, true)) {
    // Versuche lax zu matchen
    $getBetreffLower = mb_strtolower($getBetreff);
    if (str_contains($getBetreffLower, 'gutschein')) {
        $getBetreff = 'Gutschein';
    } elseif (str_contains($getBetreffLower, 'gruppe') || str_contains($getBetreffLower, 'group')) {
        $getBetreff = 'Gruppenfahrt';
    } elseif (str_contains($getBetreffLower, 'termin')) {
        $getBetreff = 'Termin anfragen';
    } else {
        $getBetreff = 'Allgemeine Anfrage';
    }
}

$breadcrumbs = [
    ['name' => 'Start',   'url' => '/'],
    ['name' => 'Kontakt', 'url' => '/kontakt.php'],
];
seo_head([
    'title'             => t('kontakt_title', 'Kontakt'),
    'description'       => t('kontakt_lead', 'Kontaktieren Sie uns für Anfragen rund um Ballonfahrten, Gutscheine und Gruppenfahrten.'),
    'canonical'         => 'https://www.ballonsport-krohmer.de/kontakt.php',
    'og_image_key'      => 'kontakt_hero',
    'preload_image_key' => 'kontakt_hero',
    'osm'               => true,
    'breadcrumbs'       => $breadcrumbs,
]);
include __DIR__ . '/../src/partials/header.php';
include __DIR__ . '/../src/partials/breadcrumbs.php';
?>

<!-- =====================================================================
     PAGE HERO (kompakt)
     ===================================================================== -->
<section class="hero hero--compact" aria-label="<?= t('kontakt_title') ?>">
    <?= img('kontakt_hero', 'Kontakt zu Ballonsport Krohmer', [
        'class'    => 'hero__bg',
        'priority' => true,
        'sizes'    => '100vw',
    ]) ?>
    <div class="hero__overlay"></div>
    <div class="container hero__inner">
        <h1 class="hero__title"><?= t('kontakt_title') ?></h1>
        <p class="hero__sub"><?= t('kontakt_lead') ?></p>
    </div>
</section>

<!-- =====================================================================
     ZWEISPALTIGES LAYOUT: KONTAKTDATEN + FORMULAR
     ===================================================================== -->
<section class="section" aria-labelledby="kontakt-section-heading">
    <div class="container">
        <h2 class="sr-only" id="kontakt-section-heading">Kontakt aufnehmen</h2>
        <div class="kontakt-layout">

            <!-- Linke Spalte: Kontaktdaten -->
            <aside class="kontakt-info">
                <div class="card">
                    <div class="card__body">
                        <h3 class="card__title" style="margin-bottom:var(--space-4)">Adresse &amp; Kontakt</h3>

                        <address style="margin-bottom:var(--space-5)">
                            <strong><?= t('kontakt_company') ?></strong><br>
                            <?= t('kontakt_owner') ?><br>
                            <?= t('kontakt_street') ?><br>
                            <?= t('kontakt_zip_city') ?>
                        </address>

                        <ul class="kontakt-info__list">
                            <li>
                                <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" width="18" height="18" class="icon" style="color:var(--c-sky-500)">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                <a href="tel:+49712721173"><?= t('kontakt_phone_display') ?></a>
                            </li>
                            <li>
                                <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" width="18" height="18" class="icon" style="color:var(--c-sky-500)">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                Fax: <?= t('kontakt_fax_display') ?>
                            </li>
                            <li>
                                <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" width="18" height="18" class="icon" style="color:var(--c-sky-500)">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                <a href="mailto:<?= t('kontakt_email_display') ?>"><?= t('kontakt_email_display') ?></a>
                            </li>
                        </ul>

                        <div class="prose" style="margin-top:var(--space-5)">
                            <?= t_raw('kontakt_hours_html') ?>
                        </div>

                        <!-- OpenStreetMap (DSGVO-freundlich) -->
                        <div class="kontakt-map" style="margin-top:var(--space-6)">
                            <iframe
                                title="Standort Ballonsport Krohmer auf OpenStreetMap"
                                src="https://www.openstreetmap.org/export/embed.html?bbox=9.2147%2C48.5397%2C9.2347%2C48.5497&amp;layer=mapnik"
                                width="100%"
                                height="320"
                                class="kontakt-map__iframe"
                                style="border:1px solid var(--c-line);border-radius:var(--radius-md)"
                                loading="lazy"
                                referrerpolicy="no-referrer"
                            ></iframe>
                            <p style="font-size:0.8125rem;color:var(--c-ink-300);margin-top:var(--space-2)">
                                <a href="https://www.openstreetmap.org/?mlat=48.5447&amp;mlon=9.2247#map=15/48.5447/9.2247" target="_blank" rel="noopener noreferrer">Größere Karte auf OpenStreetMap</a>
                            </p>
                        </div>

                    </div>
                </div>
            </aside>

            <!-- Rechte Spalte: Kontaktformular -->
            <div class="kontakt-form-wrap">

                <?php if (!empty($errors)): ?>
                <div class="alert alert--error" role="alert" style="margin-bottom:var(--space-5)">
                    <strong>Bitte korrigieren Sie folgende Fehler:</strong>
                    <ul style="margin-top:var(--space-2);padding-left:var(--space-5)">
                        <?php foreach ($errors as $error): ?>
                        <li><?= e($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <form
                    class="form"
                    method="POST"
                    action="/kontakt.php"
                    novalidate
                    aria-label="Kontaktformular"
                >
                    <!-- CSRF -->
                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

                    <!-- Honeypot (für Bots) -->
                    <div class="visually-hidden" aria-hidden="true" style="display:none">
                        <label for="website">Website (bitte leer lassen)</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <!-- Name -->
                    <div class="form__field">
                        <label class="form__label form__label--required" for="name">Name</label>
                        <input
                            class="form__input"
                            type="text"
                            id="name"
                            name="name"
                            required
                            autocomplete="name"
                            enterkeyhint="next"
                            value="<?= isset($_POST['name']) ? e($_POST['name']) : '' ?>"
                        >
                    </div>

                    <!-- E-Mail -->
                    <div class="form__field">
                        <label class="form__label form__label--required" for="email">E-Mail</label>
                        <input
                            class="form__input"
                            type="email"
                            id="email"
                            name="email"
                            required
                            autocomplete="email"
                            inputmode="email"
                            enterkeyhint="next"
                            value="<?= isset($_POST['email']) ? e($_POST['email']) : '' ?>"
                        >
                    </div>

                    <!-- Telefon (optional) -->
                    <div class="form__field">
                        <label class="form__label" for="telefon">Telefon <span style="font-weight:400;color:var(--c-ink-300)">(optional)</span></label>
                        <input
                            class="form__input"
                            type="tel"
                            id="telefon"
                            name="telefon"
                            autocomplete="tel"
                            inputmode="tel"
                            enterkeyhint="next"
                            value="<?= isset($_POST['telefon']) ? e($_POST['telefon']) : '' ?>"
                        >
                    </div>

                    <!-- Betreff -->
                    <div class="form__field">
                        <label class="form__label form__label--required" for="betreff">Betreff</label>
                        <select class="form__input form__select" id="betreff" name="betreff" required>
                            <?php
                            $betreffs = ['Allgemeine Anfrage', 'Termin anfragen', 'Gutschein', 'Gruppenfahrt'];
                            $selected = $_POST['betreff'] ?? $getBetreff;
                            foreach ($betreffs as $b):
                                $sel = ($b === $selected) ? ' selected' : '';
                            ?>
                            <option value="<?= e($b) ?>"<?= $sel ?>><?= e($b) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Nachricht -->
                    <div class="form__field">
                        <label class="form__label form__label--required" for="nachricht">Nachricht</label>
                        <textarea
                            class="form__textarea"
                            id="nachricht"
                            name="nachricht"
                            required
                            rows="6"
                            enterkeyhint="send"
                        ><?= isset($_POST['nachricht']) ? e($_POST['nachricht']) : '' ?></textarea>
                    </div>

                    <!-- Datenschutz-Checkbox -->
                    <div class="form__field form__field--check">
                        <label class="form__check-label">
                            <input
                                type="checkbox"
                                name="datenschutz"
                                value="1"
                                required
                                <?= !empty($_POST['datenschutz']) ? 'checked' : '' ?>
                            >
                            Ich habe die <a href="/datenschutz.php" target="_blank" rel="noopener">Datenschutzerklärung</a> gelesen und stimme der Verarbeitung meiner Daten zur Bearbeitung meiner Anfrage zu. <span style="color:var(--c-sunset-500)">*</span>
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary btn-lg btn--full-mobile">
                            Anfrage absenden
                        </button>
                    </div>

                    <p style="font-size:0.8125rem;color:var(--c-ink-300);margin:0">
                        Felder mit <span style="color:var(--c-sunset-500)">*</span> sind Pflichtfelder.
                    </p>

                </form>
            </div><!-- /.kontakt-form-wrap -->
        </div><!-- /.kontakt-layout -->
    </div>
</section>

<!-- =====================================================================
     ANFAHRT + ERREICHBARKEIT
     ===================================================================== -->
<section class="section section--alt" aria-labelledby="anfahrt-heading">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" id="anfahrt-heading">Anfahrt &amp; Erreichbarkeit</h2>
        </div>
        <div class="grid grid--2">
            <div class="card">
                <div class="card__body">
                    <h3 class="card__title" style="margin-bottom:var(--space-4)">Mit dem Auto</h3>
                    <div class="prose">
                        <?= t_raw('kontakt_anfahrt_html') ?>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card__body">
                    <h3 class="card__title" style="margin-bottom:var(--space-4)">Außerhalb der Bürozeiten</h3>
                    <div class="prose">
                        <?= t_raw('kontakt_offhours_html') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../src/partials/footer.php'; ?>
