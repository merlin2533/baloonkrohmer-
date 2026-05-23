<?php
/**
 * Ballonsport Krohmer — Admin Login
 */
declare(strict_types=1);

define('ROOT', dirname(__DIR__, 2));
require_once ROOT . '/src/bootstrap.php';

// Bereits eingeloggt? Weiterleiten
if (is_admin()) {
    header('Location: /admin/index.php');
    exit;
}

$error = '';

// POST-Handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Brute-Force-Schutz
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = [];
    }

    // Alte Versuche bereinigen (älter als 60 Sekunden)
    $cutoff = time() - 60;
    $_SESSION['login_attempts'] = array_filter(
        $_SESSION['login_attempts'],
        fn(int $t) => $t >= $cutoff
    );

    if (count($_SESSION['login_attempts']) >= 3) {
        sleep(2);
        $error = 'Zu viele Versuche, bitte warten.';
    } else {
        // CSRF prüfen
        if (!csrf_check($_POST['csrf_token'] ?? null)) {
            $error = 'Ungültige Anfrage. Bitte Seite neu laden und erneut versuchen.';
        } else {
            $password = $_POST['password'] ?? '';
            if (login($password)) {
                // Erfolgreich eingeloggt
                header('Location: /admin/index.php');
                exit;
            } else {
                // Fehlversuch registrieren
                $_SESSION['login_attempts'][] = time();
                sleep(1);
                $error = 'Falsches Passwort.';
            }
        }
    }
}

// Token für GET und nach fehlgeschlagenem POST erzeugen
$token = csrf_token();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Admin-Login — Ballonsport Krohmer</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
<div class="a-login-page">
    <div class="a-login-card">

        <div class="a-login-logo">
            <img src="/assets/img/logo.svg" alt="Ballonsport Krohmer Logo" height="48">
        </div>

        <h1>Admin-Bereich</h1>

        <?php if ($error !== ''): ?>
            <div class="a-banner a-banner--error" role="alert">
                <?= e($error) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/admin/login.php" novalidate>
            <input type="hidden" name="csrf_token" value="<?= e($token) ?>">

            <div class="a-field">
                <label class="a-label" for="password">Passwort</label>
                <input
                    class="a-input"
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    required
                    autofocus
                >
            </div>

            <button type="submit" class="a-btn a-btn--primary" style="width:100%;">
                Anmelden
            </button>
        </form>

        <a href="/" class="a-login-back">← zurück zur Webseite</a>

    </div>
</div>
</body>
</html>
