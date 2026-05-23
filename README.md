# Ballonsport Krohmer — Website

Moderner Relaunch der Webseite ballonsport-krohmer.de in PHP 8 + SQLite. Alle Texte und Bilder sind über ein passwortgeschütztes Admin-Panel bearbeitbar, ohne dass dafür Programmierkenntnisse nötig sind.

---

## Features

- Vollständig editierbare Texte und Bilder über das Admin-Panel (kein CMS-Overhead)
- Passwortgeschützter Admin-Bereich mit CSRF-Schutz und Brute-Force-Absicherung
- Automatische Datenbankanlage und -befüllung beim ersten Seitenaufruf
- SEO-optimiert: per-Seite Meta-Tags, JSON-LD (LocalBusiness + FAQPage), Open Graph, Twitter Cards
- sitemap.xml und robots.txt vorhanden
- Mobile-First-Layout, lazy-loaded Bilder, Gzip-Komprimierung
- Klare CTAs für Google Ads-Kampagnen (Click-to-Call, Gutschein, Kontaktformular)
- Danke-Seite (`/danke.php`) als Conversion-Ziel, noindex gesetzt

---

## Tech-Stack

- **Sprache:** PHP 8.1+
- **Datenbank:** SQLite 3 (kein externer Datenbankserver nötig)
- **Webserver:** Apache mit mod_rewrite (getestet auf typischen Shared-Hosting-Umgebungen wie IONOS, Strato, All-Inkl)
- **CSS/JS:** Vanilla (kein Framework-Overhead), Datei `public/assets/css/styles.css` und `public/assets/js/main.js`
- **Keine Composer-Abhängigkeiten** — alles läuft out-of-the-box

---

## Schnellstart (lokal)

**Voraussetzungen:**

- PHP 8.1 oder neuer (mit SQLite3-Extension, die standardmäßig aktiv ist)
- Keine weiteren Abhängigkeiten

**Server starten:**

```bash
php -S 0.0.0.0:8000 -t public
```

**Browser öffnen:**

- Startseite: http://localhost:8000
- Admin-Panel: http://localhost:8000/admin/login.php
- Admin-Passwort: `krohmer2026`

Beim ersten Aufruf wird die SQLite-Datenbank automatisch angelegt und mit allen Standard-Inhalten befüllt.

---

## Deployment (Shared Hosting — Beispiel IONOS / Strato / All-Inkl)

### 1. Dateien hochladen

Laden Sie den gesamten Repository-Inhalt per FTP auf Ihren Hosting-Account hoch.

**Wichtig:** Setzen Sie den Document Root (Webroot) Ihrer Domain auf das Unterverzeichnis `public/`. Das ist die sauberste Konfiguration. Die Wurzel-Datei `.htaccess` versucht zwar einen Fallback (Anfragen von `/` auf `/public/` umzuleiten), aber `DocumentRoot=public/` ist zuverlässiger und sicherer.

Bei IONOS / Strato geht das im Hosting-Verwaltungspanel unter "Domains" → "Webspace" → "Verzeichnis" → `public/` eintragen.

### 2. Verzeichnisrechte setzen

Folgende Verzeichnisse müssen für den Webserver schreibbar sein:

```bash
chmod 755 data/
chmod 755 public/uploads/
```

Falls Ihr Hoster Owner-basierte Berechtigungen nutzt (z. B. suEXEC), reicht `755`. Bei `www-data`-basierten Setups ggf. `chown www-data:www-data data/ public/uploads/`.

### 3. Konfiguration anpassen

```bash
cp config/config.example.php config/config.php
```

Öffnen Sie `config/config.php` in einem Texteditor und passen Sie mindestens das Admin-Passwort an:

```php
'admin_password' => 'IhrSicheresPasswort2026',
```

`config/config.php` ist in `.gitignore` eingetragen und wird nicht eingecheckt — Ihre Änderungen bleiben beim nächsten Deployment erhalten (solange Sie die Datei nicht manuell überschreiben).

### 4. Erste Seite aufrufen

Rufen Sie Ihre Domain auf. Die Datenbank `data/krohmer.sqlite` wird automatisch angelegt und mit allen Standard-Texten und -Bildern befüllt. Sie müssen nichts manuell einrichten.

### 5. Admin-Panel aufrufen

```
https://www.ihre-domain.de/admin/login.php
```

Melden Sie sich mit dem Passwort aus Ihrer `config/config.php` an.

---

## Konfiguration

Alle Einstellungen befinden sich in `config/config.php` (aus `config/config.example.php` kopieren):

| Schlüssel        | Beschreibung                                           | Standardwert                        |
|------------------|--------------------------------------------------------|-------------------------------------|
| `admin_password` | Passwort für das Admin-Panel — **unbedingt ändern!**   | `krohmer2026`                       |
| `site_url`       | Basis-URL der Website (ohne abschließenden Slash)      | `https://www.ballonsport-krohmer.de`|
| `site_name`      | Anzeigename der Website                                | `Ballonsport Krohmer`               |
| `contact_email`  | Kontakt-E-Mail-Adresse (für JSON-LD und Footer)        | `info@ballonsport-krohmer.de`       |
| `contact_phone`  | Telefonnummer (E.164-Format für JSON-LD)               | `+49 7127 21173`                    |
| `session_name`   | Name des Session-Cookies                               | `krohmer_sess`                      |

---

## Admin-Panel

**URL:** `/admin/login.php`

**Standard-Passwort:** `krohmer2026` — bitte sofort in `config/config.php` ändern!

### Funktionen

**Texte bearbeiten (`/admin/content.php`):**

- Alle Seiteninhalte sind nach Bereichen gruppiert (Hero, USPs, FAQ, Preise, etc.)
- Klicken Sie auf einen Eintrag, bearbeiten Sie den Text und speichern Sie
- HTML-Felder (erkennbar am Suffix `_html`) unterstützen einfaches HTML wie `<p>`, `<strong>`, `<a>`

**Bilder verwalten (`/admin/images.php`):**

- Vorschau aller Bilder auf einen Blick
- Bild ersetzen: Button "Ersetzen" klicken, neue Datei auswählen (JPG, PNG, WebP, max. 5 MB)
- Hochgeladene Bilder werden unter `public/uploads/` gespeichert

### Sicherheitshinweise

- CSRF-Schutz auf allen Formularen
- Brute-Force-Schutz (max. 5 Fehlversuche, danach Sperre)
- Admin-Bereich ist mit `noindex` gesperrt — taucht nicht in Suchmaschinen auf
- `config/config.php` ist aus dem Web nicht aufrufbar (Apache-Regel in `.htaccess`)

---

## Datenbank

- **Datei:** `data/krohmer.sqlite`
- Die Datei wird beim ersten Seitenaufruf automatisch erstellt
- Schema: `src/schema.php` (idempotente `CREATE TABLE IF NOT EXISTS`-Statements)
- Seed-Daten (Standardtexte und Bild-Keys): `src/seed.php`

**Backup:** Sichern Sie einfach die Datei `data/krohmer.sqlite` — das ist die gesamte Datenbank.

**Datenbanktabellen:**

| Tabelle   | Inhalt                                           |
|-----------|--------------------------------------------------|
| `content` | Alle editierbaren Texte (Key-Value-Paare)        |
| `images`  | Alle Bild-Einträge (Key, Dateiname, Alt-Text)    |

---

## Bilder austauschen

**Über das Admin-Panel (empfohlen):**

1. `/admin/images.php` aufrufen
2. Beim gewünschten Bild auf "Ersetzen" klicken
3. Neue Datei auswählen und hochladen

**Manuell (für Entwickler):**

1. Neue Datei in `public/uploads/` ablegen
2. In der Datenbank den `filename`-Eintrag für den entsprechenden Image-Key aktualisieren:
   ```sql
   UPDATE images SET filename = 'uploads/mein-bild.webp' WHERE key = 'hero_main';
   ```

**Alle Image-Keys** sind in `src/seed.php` aufgelistet, u. a.:

| Key              | Verwendung                        |
|------------------|-----------------------------------|
| `hero_main`      | Hero-Bild auf der Startseite      |
| `home_about`     | Bild im About-Bereich             |
| `ballon_dogkr`   | Bild Ballon D-OGKR                |
| `ballon_doaak`   | Bild Ballon D-OAAK                |
| `ballon_doaam`   | Bild Ballon D-OAAM                |
| `og_default`     | Standard Open-Graph-Bild          |
| `gallery_01`–`gallery_15` | Galeriebilder             |

---

## Texte ändern

**Über das Admin-Panel (empfohlen):**

1. `/admin/content.php` aufrufen
2. Gewünschten Eintrag bearbeiten und speichern

**Alle Content-Keys** sind in `src/seed.php` aufgelistet. Wichtige Beispiele:

| Key              | Verwendung                           |
|------------------|--------------------------------------|
| `hero_title`     | Hauptüberschrift auf der Startseite  |
| `hero_subtitle`  | Untertitel auf der Startseite        |
| `preise_adult_price` | Preis Erwachsene                 |
| `faq_q1`         | FAQ-Frage 1                          |
| `faq_a1_html`    | FAQ-Antwort 1 (HTML erlaubt)         |
| `kontakt_phone_display` | Telefonnummer im Footer       |

---

## SEO

- **Meta-Tags:** Jede Seite hat eigenen Titel, Description und kanonische URL (konfiguriert via `seo_head()` in jeder PHP-Seite)
- **JSON-LD:** LocalBusiness-Schema auf allen Seiten; FAQPage-Schema zusätzlich auf `/faq.php`
- **Open Graph + Twitter Cards:** vollständig implementiert
- **sitemap.xml:** statisch unter `public/sitemap.xml`
- **robots.txt:** unter `public/robots.txt`
- **Mobile-First:** responsive Layout, lazy-loaded Bilder
- **Komprimierung:** Gzip/Deflate via Apache mod_deflate

**Nach dem Deployment empfohlen:**

1. Google Search Console einrichten: https://search.google.com/search-console
2. Bing Webmaster Tools einrichten: https://www.bing.com/webmasters
3. sitemap.xml in beiden Tools einreichen: `https://www.ballonsport-krohmer.de/sitemap.xml`
4. Nach Content-Änderungen die `<lastmod>`-Datumswerte in `public/sitemap.xml` aktualisieren

---

## SEA (Google Ads)

Die Website ist für Google Ads-Kampagnen vorbereitet:

- **Klare CTAs:** "Jetzt Termin anfragen", "Gutschein verschenken", Click-to-Call-Button
- **Trust-Signals:** Erfahrung seit 1998, Versicherungshinweis, Bewertungen (erweiterbar)
- **Conversion-Ziel:** `/danke.php` ist die Thank-you-Page nach dem Kontaktformular (noindex gesetzt)
- **Google Tag Manager:** Bei Bedarf GTM-Snippet in `src/seo.php` direkt nach dem öffnenden `<head>`-Tag einfügen. Dort ist auch der JSON-LD-Block — GTM gehört davor.

---

## Verzeichnis-Struktur

```
baloonkrohmer-/
├── .htaccess                   # Root-Rewrite (Fallback, wenn nicht public/ als Webroot)
├── .gitignore
├── README.md
│
├── config/
│   ├── config.example.php      # Vorlage — nach config.php kopieren und anpassen
│   └── config.php              # Lokale Konfiguration (nicht im Git)
│
├── data/
│   └── krohmer.sqlite          # SQLite-Datenbank (wird automatisch angelegt)
│
├── src/                        # PHP-Bibliothek (nicht direkt über Web erreichbar)
│   ├── auth.php                # Session-Authentifizierung, Brute-Force-Schutz
│   ├── bootstrap.php           # Initialisierung (Config, Session, Helper, DB)
│   ├── content.php             # t(), t_raw(), set_content()
│   ├── db.php                  # PDO-Singleton, Migration und Seed-Auslöser
│   ├── helpers.php             # e(), url(), asset()
│   ├── images.php              # img(), img_url(), save_image()
│   ├── schema.php              # Datenbankschema (CREATE TABLE)
│   ├── seed.php                # Standard-Inhalte und Bild-Keys
│   ├── seo.php                 # seo_head() — <head>-Block mit JSON-LD
│   └── partials/
│       ├── admin_layout_top.php
│       ├── admin_layout_bottom.php
│       ├── cta_bar.php         # Wiederverwendbare CTA-Sektion
│       ├── footer.php
│       ├── header.php          # </head><body>, Sticky-Header
│       └── nav.php             # Hauptnavigation
│
└── public/                     # Webroot — DocumentRoot zeigt hierauf
    ├── index.php               # Startseite
    ├── ballonfahren.php
    ├── unsere-ballone.php
    ├── preise.php
    ├── galerie.php
    ├── faq.php
    ├── kontakt.php
    ├── impressum.php
    ├── datenschutz.php
    ├── danke.php               # Danke-Seite nach Formular-Submit (noindex)
    ├── 404.php                 # Custom 404-Seite
    ├── sitemap.xml             # Statische Sitemap
    ├── robots.txt
    │
    ├── admin/
    │   ├── login.php
    │   ├── logout.php
    │   ├── index.php           # Admin-Dashboard
    │   ├── content.php         # Texte bearbeiten
    │   ├── images.php          # Bilder verwalten
    │   ├── save-content.php    # AJAX/Form-Handler für Textspeicherung
    │   └── upload.php          # Bild-Upload-Handler
    │
    ├── assets/
    │   ├── css/
    │   │   ├── styles.css      # Frontend-Stylesheet
    │   │   └── admin.css       # Admin-Stylesheet
    │   ├── js/
    │   │   └── main.js         # Frontend-JavaScript
    │   ├── fonts/
    │   └── img/
    │       ├── logo.svg
    │       └── placeholder-*.svg
    │
    └── uploads/                # Hochgeladene Bilder (nicht im Git, außer .gitkeep)
```

---

## Wartung

**Regelmäßiges Backup (empfohlen: wöchentlich):**

```bash
# Datenbank sichern
cp data/krohmer.sqlite data/krohmer.sqlite.bak

# Uploads sichern
tar -czf uploads-backup-$(date +%Y%m%d).tar.gz public/uploads/
```

**Logs:**

PHP-Fehler werden in die Server-Logdatei geschrieben (Pfad je nach Hosting-Anbieter, oft unter `logs/php_error.log` oder im Hosting-Panel einsehbar).

**Updates:**

```bash
git pull
```

Datenbankmigrationen (neue Tabellen, Spalten) werden beim nächsten Seitenaufruf automatisch ausgeführt — die `run_migrations()`-Funktion in `src/schema.php` ist idempotent (kann beliebig oft aufgerufen werden, ohne Schaden anzurichten).

**sitemap.xml aktualisieren:**

Nach grösseren Änderungen an den Inhalten das Datum `<lastmod>` in `public/sitemap.xml` manuell auf das aktuelle Datum setzen und anschließend die Sitemap in Google Search Console neu einreichen.

---

## Lizenz / Kontakt

Diese Website ist Eigentum von Ballonsport Krohmer, Günter Krohmer, Carl-Zeiss-Straße 3, 72124 Pliezhausen.

Technische Fragen zur Website-Entwicklung richten Sie bitte an den Entwickler, nicht an den Hosting-Support.
