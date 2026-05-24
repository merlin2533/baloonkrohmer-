# Changelog

Alle relevanten Änderungen an der Webseite werden hier dokumentiert.

Die kundenfreundliche, nicht-technische Übersicht ist zusätzlich unter
`public/version.json` öffentlich abrufbar.

## [1.2] – 2026-05-24

### Hinzugefügt
- Saisonaler Banner (`season_banner.php`) direkt nach dem Header — zeigt je nach Monat Buchungs-, Saison- oder Gutschein-Hinweis
- Statistik-Bar nach dem Hero mit dynamischer Jahresberechnung (1998, Jahre Erfahrung, 3 Ballone, 5+1)
- Galerie-Teaser-Sektion (5 Bilder, Grid-Layout) zwischen "Was Sie erwartet" und "Perfekt als Geschenk"
- Neuer Content-Key `hero_anchor` mit Flugzeit-Eckdaten unterhalb der Hero-CTAs
- CSS-Block `/* Homepage Quick-Wins 1.2 */` in `styles.css` mit allen neuen Klassen

### Geändert
- Hero-Texte überarbeitet: konkreter Preis (235 €), Familie Krohmer, Hohenzollern-Referenz
- Text-Refresh: `ballonfahren_lead`, `preise_lead`, `galerie_lead`, `ballone_lead`, `home_intro_html`, `preise_voucher_html` — keine wiederholten "lautlos/unvergesslich"-Formulierungen mehr
- CTA-Button-Text verkürzt: "Häufige Fragen" statt "Häufig gestellte Fragen"

### Migration
- `bin/v12-content-update.php` — idempotentes Skript, aktualisiert 11 Content-Keys

## [1.1.1] – 2026-05-24

### Behoben (kritisch)
- Bilder lieferten auf Plesk-/Shared-Hosting HTTP 500, weil `public/uploads/.htaccess`
  Apache-Direktiven verwendete (`php_flag engine off`, Negativ-Lookahead-Regex),
  die bei eingeschränktem `AllowOverride` einen Server-Error auslösen.
  Auf das Minimum reduziert: nur noch Script-Extensions blockieren + `Options -Indexes`.
- Logo wird jetzt mit `fetchpriority="high"` und `loading="eager"` geladen
  (vorher `loading="lazy"`, was Above-the-fold-Logos verlangsamen kann).

## [1.1] – 2026-05-24

### Hinzugefügt
- Drei neue Regionalseiten für Stuttgart, Reutlingen und Tübingen mit eigenem Service-Schema
- 8 zusätzliche FAQ-Einträge (jetzt 20 statt 12) — Wunschstartorte, Gutschein-Gültigkeit, Foto/Video, Senioren, Schlechtwetter, Speisen, Hunde, Landung
- Brotkrumen-Navigation auf allen Unterseiten mit BreadcrumbList-Schema
- Service-Schema (Schema.org) auf Ballonfahren-, Preise- und Regionalseiten
- Ausführlicher Ablauf einer Ballonfahrt und detaillierte Leistungsbeschreibung
- Critical-CSS inline auf Startseite für noch schnelleren Erstaufruf
- ETag/Output-Buffering im Bootstrap für Browser-Caching wiederkehrender Besucher
- Region-Spalte im Footer mit Verlinkung zu den neuen Landingpages
- Keyword-Übersicht unter `docs/seo-keywords.md`

### Verbessert
- Sitemap und robots.txt um neue Regionalseiten erweitert
- Erweiterte Inhalte auf allen Hauptseiten (Region-Block, "Was Sie erwartet", Aussichten von oben, Technik-Erklärung)
- Open-Graph-Bild pro Seite konsistent gesetzt

### Behoben
- Bilder wurden in einigen Browsern wegen `picture { display: inline }` mit 0 × 0 px gerendert — jetzt `display: block; width: 100%`

## [1.0] – 2026-05-23

### Verbessert
- Bedienung auf Smartphones und Tablets weiter optimiert (Navigation, Buttons, Layout)
- Schnellere Ladezeiten durch optimierte Bilder und Schriften
- Performance bei wiederholten Seitenaufrufen erhöht
- Bessere Auffindbarkeit bei Google durch SEO-Polish

### Hinzugefügt
- Originalbilder von Ballonsport Krohmer in den neuen Auftritt übernommen
- Freundliche Fehlerseite für nicht gefundene Inhalte (404)
- Alle öffentlichen Seiten (Startseite, Ballonfahren, Unsere Ballone, Preise, Galerie, FAQ, Kontakt, Impressum, Datenschutz)
- Passwortgeschützter Verwaltungsbereich zum Bearbeiten von Texten und Bildern
- Öffentliche Versionsanzeige unter `public/version.json`

### Grundlage
- Erste Version des Relaunches als Basis für den neuen Webauftritt
