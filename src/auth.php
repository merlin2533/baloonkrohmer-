<?php
/**
 * Ballonsport Krohmer — Authentifizierung & CSRF
 */

/**
 * Prüft, ob der aktuelle Benutzer als Admin eingeloggt ist.
 */
function is_admin(): bool
{
    return !empty($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Bricht die Ausführung ab und leitet auf die Login-Seite um,
 * wenn der Benutzer nicht eingeloggt ist.
 */
function require_admin(): void
{
    if (!is_admin()) {
        header('Location: /admin/login.php');
        exit;
    }
}

/**
 * Prüft das Passwort und loggt den Benutzer ein.
 * Gibt true zurück, wenn das Passwort korrekt ist.
 */
function login(string $pw): bool
{
    global $CFG;

    $stored = $CFG['admin_password'] ?? '';

    if (!hash_equals($stored, $pw)) {
        return false;
    }

    // Session-ID rotieren nach Login (Session-Fixation verhindern)
    session_regenerate_id(true);

    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_login_time'] = time();

    return true;
}

/**
 * Loggt den aktuellen Benutzer aus.
 */
function logout(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    session_destroy();
}

/**
 * Gibt ein CSRF-Token für das aktuelle Session zurück (erzeugt es falls nötig).
 */
function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Prüft ein übermitteltes CSRF-Token gegen das Session-Token.
 * Gibt false zurück, wenn der Token fehlt oder nicht übereinstimmt.
 */
function csrf_check(?string $token): bool
{
    if (empty($token) || empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}
