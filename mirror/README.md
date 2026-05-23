# Mirror — Snapshot der Original-Seite ballonsport-krohmer.de

Dieses Verzeichnis enthält einen kompletten **Offline-Spiegel** der Original-Webseite
`https://www.ballonsport-krohmer.de/` zum Zeitpunkt des Relaunches.

## Zweck

- **Referenz**: Original-Inhalte (Texte, Bilder, Layout) bleiben dauerhaft verfügbar,
  auch wenn die Live-Seite irgendwann offline geht oder sich ändert.
- **Migration**: Falls nachträglich noch Inhalte fehlen, können sie hier nachgeschlagen
  werden.
- **Beweismittel**: Snapshot dokumentiert, welche Inhalte beim Relaunch übernommen
  wurden.

## NICHT öffentlich

Das Verzeichnis liegt **außerhalb von `public/`** und ist damit über den Webserver
**nicht erreichbar**. Es wird nur im Git-Repo geführt.

## Inhalt

- 9 HTML-Seiten der öffentlichen Originalseite (Start, Ballonfahren, Unsere Ballone,
  Preise, Bildergalerie, FAQ, Kontakt, Impressum, Datenschutz)
- 137 Bild-Dateien (Original-Auflösungen und WordPress-Thumbnails: -80x80, -150x150,
  -300x300, -300x200, -768x512, -1024x683, etc.)
- CSS-, JS- und Font-Assets des Original-Themes (WPBakery / Total Theme)
- WordPress-Backend-Artefakte (`wp-content/`, `wp-includes/`, `wp-json/`)

## Erstellt mit

```bash
wget --recursive --level=3 --no-clobber --page-requisites --html-extension \
     --convert-links --restrict-file-names=windows \
     --domains=ballonsport-krohmer.de,www.ballonsport-krohmer.de \
     --no-parent --execute robots=off \
     --user-agent="Mozilla/5.0 (compatible; KrohmerArchive/1.0 +reference)" \
     https://www.ballonsport-krohmer.de/
```

Datum des Snapshots: siehe `git log` für diesen Ordner.

## Verwendung

Lokal im Browser öffnen:

```bash
xdg-open mirror/www.ballonsport-krohmer.de/index.html
```

Oder einen kleinen statischen Server in diesem Verzeichnis starten:

```bash
php -S 127.0.0.1:9000 -t mirror/www.ballonsport-krohmer.de
```

Dann <http://127.0.0.1:9000/> aufrufen.
