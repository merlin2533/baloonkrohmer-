<?php
/**
 * Ballonsport Krohmer — Beispiel-Konfiguration
 *
 * Kopieren Sie diese Datei nach config/config.php und passen Sie die Werte an.
 * config/config.php ist in .gitignore und wird nicht eingecheckt.
 */
return [
    // Admin-Zugang — UNBEDINGT ÄNDERN!
    'admin_password' => 'krohmer2026',     // CHANGE ME — siehe README

    // Website-Basis-URL (kein abschließender Schrägstrich)
    'site_url'      => 'https://www.ballonsport-krohmer.de',

    // Allgemeine Site-Informationen
    'site_name'     => 'Ballonsport Krohmer',

    // Kontakt
    'contact_email' => 'info@ballonsport-krohmer.de',
    'contact_phone' => '+49 7127 21173',

    // Session-Name (muss ein gültiger Cookie-Name sein)
    'session_name'  => 'krohmer_sess',
];
