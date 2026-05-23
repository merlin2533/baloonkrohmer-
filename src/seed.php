<?php
/**
 * Ballonsport Krohmer — Datenbank-Seed
 *
 * INSERT OR IGNORE für alle Content- und Image-Keys.
 * Wird automatisch aufgerufen, wenn die content-Tabelle leer ist.
 */
function run_seed(PDO $pdo): void
{
    $now = time();

    // -------------------------------------------------------------------------
    // Content-Keys
    // -------------------------------------------------------------------------
    $contentRows = [
        // Hero
        ['hero_title',          'Seit 1998 unvergessliches Erleben'],
        ['hero_subtitle',       'Lautlos durch die Lüfte schweben — Ballonfahrten über der Schwäbischen Alb'],
        ['hero_cta_primary',    'Jetzt Termin anfragen'],
        ['hero_cta_secondary',  'Häufig gestellte Fragen'],

        // Home Intro
        ['home_intro_html',     '<p>Willkommen bei Ballonsport Krohmer. Wir lassen Sie über die Schwäbische Alb und die Regionen rund um Stuttgart, Reutlingen, Tübingen, Balingen und Hechingen schweben — das ganze Jahr, immer dann, wenn Wind und Wetter perfekt sind.</p>'],

        // USPs
        ['usp_1_title', 'Über 20 Jahre Erfahrung'],
        ['usp_1_text',  'Seit 1998 begleiten wir Menschen auf ihre erste — und oft nicht letzte — Ballonfahrt.'],
        ['usp_2_title', 'Registriertes Luftfahrtunternehmen'],
        ['usp_2_text',  'Volle Passagier-Haftpflicht- und Unfallversicherung inklusive.'],
        ['usp_3_title', 'Bis zu 25 Passagiere'],
        ['usp_3_text',  'Drei Heißluftballone für Einzelgäste, Paare und Gruppen.'],
        ['usp_4_title', 'Region & Pilot vor Ort'],
        ['usp_4_text',  'Startorte in Tübingen, Reutlingen und im Südraum Stuttgart.'],

        // Ballonfahren
        ['ballonfahren_title',      'Ballonfahren'],
        ['ballonfahren_lead',       'Über die Schwäbische Alb, Stuttgart, Reutlingen, Tübingen, Balingen und Hechingen — lautlos, sicher und unvergesslich.'],
        ['ballonfahren_intro_html', '<p>Feste Termine für Ballonfahrten gibt es nicht — denn das Wetter spielt die Hauptrolle. Wir prüfen die Witterung besonders kritisch und starten nur bei wirklich passenden Bedingungen.</p><p>Bevorzugte Startorte sind Tübingen, Reutlingen und Stuttgart. Auf Wunsch starten wir auch von Ihrem Wunschort.</p>'],

        // Ballone
        ['ballone_title', 'Unsere Ballone'],
        ['ballone_lead',  'Drei Heißluftballone für jedes Erlebnis.'],

        ['ballon_dogkr_name', 'D-OGKR — Krohmer'],
        ['ballon_dogkr_text', 'Unser Stammballon, benannt nach unserer Familie.'],
        ['ballon_doaak_name', 'D-OAAK — Alpirsbacher'],
        ['ballon_doaak_text', 'Im Zeichen der Schwarzwälder Brautradition.'],
        ['ballon_doaam_name', 'D-OAAM — Wolff & Müller'],
        ['ballon_doaam_text', 'Unser Partnerballon mit der Bauunternehmung Wolff & Müller.'],

        // Preise
        ['preise_title',        'Preise'],
        ['preise_lead',         'Transparente Tarife für Ihr Ballonerlebnis.'],
        ['preise_adult_label',  'Erwachsene'],
        ['preise_adult_price',  '235 €'],
        ['preise_adult_note',   'pro Person'],
        ['preise_youth_label',  'Kinder ab 8 Jahren & Jugendliche bis 18 Jahre'],
        ['preise_youth_price',  '210 €'],
        ['preise_youth_note',   'pro Person'],
        ['preise_group_label',  'Gruppen'],
        ['preise_group_price',  'auf Anfrage'],
        ['preise_voucher_html',    '<p>Verschenken Sie ein unvergessliches Erlebnis: <strong>Geschenkgutscheine</strong> erhalten Sie per Telefon oder E-Mail.</p>'],
        ['preise_insurance_html',  '<p>Für unsere Fahrgäste besteht eine Passagier-Haftpflicht- und Unfallversicherung.</p>'],

        // Galerie
        ['galerie_title', 'Bildergalerie'],
        ['galerie_lead',  'Eindrücke aus über zwei Jahrzehnten Ballonfahren.'],

        // FAQ
        ['faq_title', 'Häufig gestellte Fragen'],
        ['faq_lead',  'Antworten auf die wichtigsten Fragen rund um Ihre Ballonfahrt.'],

        ['faq_q1',     'Wie sollte das Wetter sein?'],
        ['faq_a1_html', '<p>Eine stabile und gute Wetterlage ist Voraussetzung für eine schöne und sichere Ballonfahrt. Bei Windstärken über 20 km/h, Regen oder Gewitter sagen wir ab und vergeben einen neuen Termin.</p>'],

        ['faq_q2',     'Wo starten wir?'],
        ['faq_a2_html', '<p>Unsere Startplätze liegen in den Regionen Reutlingen, Tübingen und im Südraum Stuttgart. Je nach Wind und Wetterlage wählt der Pilot den besten Platz aus. Individuelle Startorte sind nach Rücksprache möglich.</p>'],

        ['faq_q3',     'Wie lange geht eine Ballonfahrt?'],
        ['faq_a3_html', '<p>Wir sind ca. 1,5 Stunden mit Ihnen in der Luft — je nach Landegelände auch etwas länger. Für das gesamte Erlebnis sollten Sie 4–5 Stunden einplanen.</p>'],

        ['faq_q4',     'In welcher Jahreszeit und Tageszeit fahren wir?'],
        ['faq_a4_html', '<p>Wir fahren von Mai bis Oktober bei gutem Wetter. Unsere Startzeiten sind morgens zum Sonnenaufgang und abends ca. 3 Stunden vor Sonnenuntergang. Winterfahrten bieten wir nur für Gruppen an.</p>'],

        ['faq_q5',     'Wie kleide ich mich?'],
        ['faq_a5_html', '<p>Sportliche Freizeitbekleidung und festes Schuhwerk wie bei einer Wanderung. Die Temperaturen im Korb sind nicht kälter als am Boden. An warmen Tagen empfehlen wir eine Kopfbedeckung.</p>'],

        ['faq_q6',     'Wie hoch fährt ein Ballon?'],
        ['faq_a6_html', '<p>Flughöhen zwischen 300 und 3000 m sind möglich. In der Regel fahren wir in einer Höhe von 300–1500 m.</p>'],

        ['faq_q7',     'Können Kinder mitfahren?'],
        ['faq_a7_html', '<p>Es gibt kein Mindestalter, aber der Korbrand ist 1,10 m hoch. Kinder sollten über den Rand schauen können, damit sie das Erlebnis genießen.</p>'],

        ['faq_q8',     'Gibt es gesundheitliche Einschränkungen?'],
        ['faq_a8_html', '<p>Jeder Passagier sollte so fit sein, dass er die Zeit stehend im Ballon verbringen kann. Bei Herz-, Kreislauf- oder Lungenproblemen besprechen Sie die Fahrt bitte vorher mit Ihrem Arzt. Ab dem 4. Schwangerschaftsmonat raten wir vom Fliegen ab.</p>'],

        ['faq_q9',     'Wie viele Passagiere passen rein?'],
        ['faq_a9_html', '<p>Unsere Ballonkörbe sind für 5 Passagiere plus Pilot ausgelegt — für einen ganz persönlichen Rahmen. Für größere Gruppen stehen bis zu 4 Ballone zur Verfügung.</p>'],

        ['faq_q10',     'Wie bin ich versichert?'],
        ['faq_a10_html', '<p>Jeder Passagier ist durch eine Unfall- und Haftpflichtversicherung abgesichert, die wir als genehmigtes Luftfahrtunternehmen abgeschlossen haben.</p>'],

        ['faq_q11',     'Wie vereinbare ich einen Termin?'],
        ['faq_a11_html', '<p>Telefonisch während unserer Bürozeiten: Mo–Do 8–12 Uhr und 14–17 Uhr, Fr 8–12 Uhr — oder jederzeit per E-Mail.</p>'],

        ['faq_q12',     'Was kostet eine Ballonfahrt?'],
        ['faq_a12_html', '<p>Alle aktuellen Preise finden Sie auf der Seite <a href="/preise.php">Preise</a>.</p>'],

        // Kontakt
        ['kontakt_title',        'Kontakt'],
        ['kontakt_lead',         'Wir freuen uns auf Ihre Anfrage.'],
        ['kontakt_company',      'Ballonsport Krohmer'],
        ['kontakt_owner',        'Günter Krohmer'],
        ['kontakt_street',       'Carl-Zeiss-Straße 3'],
        ['kontakt_zip_city',     '72124 Pliezhausen'],
        ['kontakt_phone_display', '+49 (0) 7127 / 21173'],
        ['kontakt_fax_display',   '+49 (0) 7127 / 1809-11'],
        ['kontakt_email_display', 'info@ballonsport-krohmer.de'],
        ['kontakt_hours_html',   '<p><strong>Bürozeiten:</strong><br>Mo–Do 8:00–12:00 und 14:00–17:00 Uhr<br>Fr 8:00–12:00 Uhr</p>'],

        // Impressum
        ['impressum_html', '<h2>Impressum</h2>
<p>
  <strong>Ballonsport Krohmer</strong><br>
  Inhaber: Günter Krohmer<br>
  Carl-Zeiss-Straße 3<br>
  72124 Pliezhausen
</p>
<p>
  Telefon: +49 (0) 7127 / 21173<br>
  Fax: +49 (0) 7127 / 1809-11<br>
  E-Mail: <a href="mailto:info@ballonsport-krohmer.de">info@ballonsport-krohmer.de</a>
</p>
<p>
  Umsatzsteuer-Identifikationsnummer gemäß § 27 a UStG:<br>
  DE201806158
</p>
<h3>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV</h3>
<p>
  Günter Krohmer<br>
  Carl-Zeiss-Straße 3<br>
  72124 Pliezhausen
</p>
<h3>Online-Streitbeilegung</h3>
<p>
  Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:<br>
  <a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener noreferrer">https://ec.europa.eu/consumers/odr/</a>
</p>
<p>
  Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer
  Verbraucherschlichtungsstelle teilzunehmen.
</p>'],

        // Datenschutz
        ['datenschutz_html', '<h2>Datenschutzerklärung</h2>

<h3>1. Verantwortlicher</h3>
<p>
  Verantwortlicher im Sinne der Datenschutz-Grundverordnung (DSGVO):<br>
  Günter Krohmer, Ballonsport Krohmer, Carl-Zeiss-Straße 3, 72124 Pliezhausen<br>
  E-Mail: <a href="mailto:info@ballonsport-krohmer.de">info@ballonsport-krohmer.de</a>
</p>

<h3>2. Erhebung von Daten beim Aufruf der Website</h3>
<p>
  Beim Aufruf unserer Website werden durch den Webserver automatisch folgende Daten
  in Server-Logdateien gespeichert:
</p>
<ul>
  <li>IP-Adresse des anfragenden Rechners</li>
  <li>Datum und Uhrzeit des Zugriffs</li>
  <li>Name und URL der abgerufenen Datei</li>
  <li>Website, von der aus der Zugriff erfolgt (Referrer-URL)</li>
  <li>Verwendeter Browser und ggf. das Betriebssystem</li>
</ul>
<p>
  Diese Daten werden ausschließlich zur Sicherstellung eines störungsfreien Betriebs
  der Website sowie zur Verbesserung unseres Angebots genutzt. Rechtsgrundlage ist
  Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse). Die Daten werden nach spätestens
  7 Tagen gelöscht, sofern keine sicherheitsrelevante Auswertung erforderlich ist.
</p>

<h3>3. Cookies und Session</h3>
<p>
  Diese Website verwendet technisch notwendige Session-Cookies, die für den Betrieb
  des Angebots erforderlich sind (z. B. für den Admin-Bereich). Diese Cookies enthalten
  keine personenbezogenen Daten und werden nach dem Schließen des Browsers gelöscht.
  Eine Einwilligung ist hierfür nicht erforderlich (Art. 6 Abs. 1 lit. f DSGVO).
</p>

<h3>4. Kontaktformular und E-Mail-Kontakt</h3>
<p>
  Wenn Sie uns per Kontaktformular oder E-Mail kontaktieren, werden Ihre angegebenen
  Daten (Name, E-Mail-Adresse, Nachricht) zur Bearbeitung Ihrer Anfrage und für
  eventuelle Anschlussfragen bei uns gespeichert. Rechtsgrundlage ist Art. 6 Abs. 1
  lit. b DSGVO (Vertragsanbahnung) bzw. Art. 6 Abs. 1 lit. f DSGVO (berechtigtes
  Interesse an der Beantwortung von Anfragen). Diese Daten werden nach abschließender
  Bearbeitung Ihrer Anfrage gelöscht, sofern keine gesetzlichen Aufbewahrungspflichten
  bestehen.
</p>

<h3>5. Speicherdauer</h3>
<p>
  Personenbezogene Daten werden nur so lange gespeichert, wie es zur Erfüllung des
  jeweiligen Zwecks erforderlich ist oder gesetzliche Aufbewahrungsfristen bestehen.
</p>

<h3>6. Ihre Rechte als betroffene Person</h3>
<p>Sie haben gemäß Art. 15–21 DSGVO folgende Rechte:</p>
<ul>
  <li><strong>Auskunftsrecht</strong> (Art. 15 DSGVO): Sie können Auskunft über die zu Ihrer Person gespeicherten Daten verlangen.</li>
  <li><strong>Recht auf Berichtigung</strong> (Art. 16 DSGVO): Sie können die Berichtigung unrichtiger Daten verlangen.</li>
  <li><strong>Recht auf Löschung</strong> (Art. 17 DSGVO): Sie können unter bestimmten Voraussetzungen die Löschung Ihrer Daten verlangen.</li>
  <li><strong>Recht auf Einschränkung der Verarbeitung</strong> (Art. 18 DSGVO)</li>
  <li><strong>Recht auf Datenübertragbarkeit</strong> (Art. 20 DSGVO)</li>
  <li><strong>Widerspruchsrecht</strong> (Art. 21 DSGVO): Sie können der Verarbeitung Ihrer Daten widersprechen.</li>
</ul>
<p>
  Zur Ausübung Ihrer Rechte wenden Sie sich bitte per E-Mail an
  <a href="mailto:info@ballonsport-krohmer.de">info@ballonsport-krohmer.de</a>.
</p>

<h3>7. Beschwerderecht bei der Aufsichtsbehörde</h3>
<p>
  Sie haben das Recht, sich bei einer Datenschutz-Aufsichtsbehörde über die Verarbeitung
  Ihrer personenbezogenen Daten zu beschweren. Die zuständige Aufsichtsbehörde für
  Baden-Württemberg ist der Landesbeauftragte für den Datenschutz und die
  Informationsfreiheit Baden-Württemberg (LfDI BW),
  <a href="https://www.baden-wuerttemberg.datenschutz.de" target="_blank" rel="noopener noreferrer">www.baden-wuerttemberg.datenschutz.de</a>.
</p>

<h3>8. Datensicherheit (SSL/TLS)</h3>
<p>
  Diese Website nutzt aus Sicherheitsgründen und zum Schutz der Übertragung vertraulicher
  Inhalte eine SSL- bzw. TLS-Verschlüsselung. Eine verschlüsselte Verbindung erkennen
  Sie daran, dass die Adresszeile des Browsers von „http://" auf „https://" wechselt
  und an dem Schloss-Symbol in Ihrer Browserzeile.
</p>'],
    ];

    $stmtContent = $pdo->prepare(
        'INSERT OR IGNORE INTO content (key, value, updated_at) VALUES (:key, :value, :now)'
    );

    foreach ($contentRows as [$key, $value]) {
        $stmtContent->execute([':key' => $key, ':value' => $value, ':now' => $now]);
    }

    // -------------------------------------------------------------------------
    // Image-Keys
    // -------------------------------------------------------------------------
    // Image-Keys: Default-Werte zeigen auf die Original-Bilder unter /public/uploads/.
    // Wenn die Datei nicht existiert, liefert img_url() automatisch ein passendes
    // SVG-Placeholder zurück, sodass die Seite weiterhin funktioniert.
    $imageRows = [
        ['logo',              'logo.png',              'Ballonsport Krohmer'],
        ['hero_main',         'hero_main.jpg',         'Heißluftballon über der Schwäbischen Alb bei Sonnenaufgang'],
        ['home_about',        'hero_main.jpg',         'Heißluftballon startet bei Sonnenaufgang'],
        ['ballonfahren_hero', 'ballonfahren_hero.jpg', 'Ballonfahrt über die Schwäbische Alb'],
        ['ballon_dogkr',      'ballon_dogkr.jpg',      'Heißluftballon D-OGKR Krohmer'],
        ['ballon_doaak',      'ballon_doaak.jpg',      'Heißluftballon D-OAAK Alpirsbacher'],
        ['ballon_doaam',      'ballon_doaam.jpg',      'Heißluftballon D-OAAM Wolff und Müller'],
        ['kontakt_hero',      'kontakt_hero.jpg',      'Kontakt zu Ballonsport Krohmer'],
        ['preise_hero',       'preise_hero.jpg',       'Preise und Pakete'],
        ['og_default',        'hero_main.jpg',         'Ballonsport Krohmer'],
    ];

    // gallery_01 bis gallery_15
    for ($i = 1; $i <= 15; $i++) {
        $imageRows[] = [
            sprintf('gallery_%02d', $i),
            sprintf('gallery_%02d.jpg', $i),
            sprintf('Eindruck einer Ballonfahrt — Bild %d', $i),
        ];
    }

    $stmtImage = $pdo->prepare(
        'INSERT OR IGNORE INTO images (key, filename, alt, updated_at) VALUES (:key, :filename, :alt, :now)'
    );

    foreach ($imageRows as [$key, $filename, $alt]) {
        $stmtImage->execute([':key' => $key, ':filename' => $filename, ':alt' => $alt, ':now' => $now]);
    }
}
