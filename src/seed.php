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
        ['hero_title',          'Schwäbische Alb von oben — seit 1998 mit Familie Krohmer'],
        ['hero_subtitle',       'Sonnenaufgang über Hohenzollern, lautlose Fahrt über die Alb-Hochfläche, Champagner-Taufe nach der Landung — Ihre Ballonfahrt ab 235 €.'],
        ['hero_cta_primary',    'Termin sichern — ab 235 €'],
        ['hero_cta_secondary',  'Häufige Fragen'],
        ['hero_anchor',         '1,5 Stunden Flug · 4–5 Stunden Gesamterlebnis · 5 Passagiere + Pilot pro Korb'],

        // Home Intro
        ['home_intro_html',     '<p>Willkommen bei Ballonsport Krohmer aus Pliezhausen. Seit 1998 begleiten wir Menschen auf ihre erste — und oft nicht letzte — Ballonfahrt über die Schwäbische Alb. Drei Heißluftballone, Startorte in Tübingen, Reutlingen und im Südraum Stuttgart, persönliche Betreuung von Familie Krohmer.</p>'],

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
        ['ballonfahren_lead',       'Über die Alb. Über den Wolken. Mit Ihnen — sicher, lautlos, persönlich.'],
        ['ballonfahren_intro_html', '<p>Feste Termine für Ballonfahrten gibt es nicht — denn das Wetter spielt die Hauptrolle. Wir prüfen die Witterung besonders kritisch und starten nur bei wirklich passenden Bedingungen.</p><p>Bevorzugte Startorte sind Tübingen, Reutlingen und Stuttgart. Auf Wunsch starten wir auch von Ihrem Wunschort.</p>'],

        // Ballone
        ['ballone_title', 'Unsere Ballone'],
        ['ballone_lead',  'Drei Ballone aus über 25 Jahren Erfahrung — vom kleinen Korb für fünf bis zur Gruppenfahrt mit bis zu vier Ballonen parallel.'],

        ['ballon_dogkr_name', 'D-OGKR — Krohmer'],
        ['ballon_dogkr_text', 'Unser Stammballon, benannt nach unserer Familie.'],
        ['ballon_doaak_name', 'D-OAAK — Alpirsbacher'],
        ['ballon_doaak_text', 'Im Zeichen der Schwarzwälder Brautradition.'],
        ['ballon_doaam_name', 'D-OAAM — Wolff & Müller'],
        ['ballon_doaam_text', 'Unser Partnerballon mit der Bauunternehmung Wolff & Müller.'],

        // Preise
        ['preise_title',        'Preise'],
        ['preise_lead',         'Klare Preise ab 235 € pro Person — inklusive Versicherung, Champagner-Taufe und Urkunde.'],
        ['preise_adult_label',  'Erwachsene'],
        ['preise_adult_price',  '235 €'],
        ['preise_adult_note',   'pro Person'],
        ['preise_youth_label',  'Kinder ab 8 Jahren & Jugendliche bis 18 Jahre'],
        ['preise_youth_price',  '210 €'],
        ['preise_youth_note',   'pro Person'],
        ['preise_group_label',  'Gruppen'],
        ['preise_group_price',  'auf Anfrage'],
        ['preise_voucher_html',    '<p>Verschenken Sie ein besonderes Erlebnis: <strong>Geschenkgutscheine</strong> erhalten Sie per Telefon oder E-Mail.</p>'],
        ['preise_insurance_html',  '<p>Für unsere Fahrgäste besteht eine Passagier-Haftpflicht- und Unfallversicherung.</p>'],

        // Galerie
        ['galerie_title', 'Bildergalerie'],
        ['galerie_lead',  'Echte Bilder von echten Fahrten — über die Alb, durch das Schwäbische Mittelgebirge.'],

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

        // Ballonfahren — neue SEO-Blöcke
        ['ballonfahren_ablauf_html', '<p>Der vollständige Ablauf einer Ballonfahrt: Begrüßung, Wetter-Check, Ballon aufrüsten, Start, ca. 1,5 Stunden Fahrt, Landung, Champagner-Taufe und Rücktransport.</p>'],
        ['ballonfahren_aussicht_html', '<p>Von oben sehen Sie die Schwäbische Alb mit Burg Hohenzollern, Schloss Lichtenstein, den Reutlinger Alb-Trauf, die Filderebene und bei klarer Sicht bis zu den Alpen.</p>'],

        // Ballone — Technik
        ['ballone_technik_html', '<p>Ein Heißluftballon funktioniert nach dem Prinzip der Auftriebskraft: Erhitzte Luft ist leichter als kalte Luft. Der Brenner erhitzt die Luft in der Hülle auf bis zu 120 °C. Die Fahrtrichtung bestimmt der Wind; der Pilot steuert die Höhe.</p>'],

        // Home — neue Blöcke
        ['home_region_html',   '<p>Die Schwäbische Alb ist unsere Heimat. Von Pliezhausen aus starten wir zu Ballonfahrten über Reutlingen, Tübingen, Stuttgart, Balingen und Hechingen.</p>'],
        ['home_erwartet_html', '<p>Begrüßung und Wetter-Briefing, Aufrüsten des Ballons, Start, ca. 1,5 h Fahrt, Landung, Champagner-Taufe mit Urkunde und Rücktransport zum Startplatz.</p>'],

        // Preise — neue Blöcke
        ['preise_included_html',       '<ul><li>Sicherheits-Briefing</li><li>Ca. 1,5 h Ballonfahrt</li><li>Passagier-Haftpflicht- und Unfallversicherung</li><li>Champagner nach Landung</li><li>Ballonfahrer-Taufe und Urkunde</li><li>Rücktransport zum Startplatz</li></ul>'],
        ['preise_gruppe_html',         '<p>Für Gruppen ab 6 Personen individuelle Angebote. Bis zu 4 Ballone gleichzeitig, bis zu 25 Passagiere. Anfrage per E-Mail oder Telefon.</p>'],
        ['preise_gutschein_detail_html','<p>Gutscheine per Telefon oder E-Mail erhältlich. Lange Gültigkeitsdauer, Termin nach Verfügbarkeit. Beliebt als Geschenk für Geburtstage, Hochzeitstage, Jubiläen.</p>'],

        // Kontakt — neue Blöcke
        ['kontakt_anfahrt_html',  '<p>Pliezhausen liegt zwischen Tübingen und Reutlingen, ca. 15 km südlich von Stuttgart. Von der A8 Abfahrt Denkendorf, von der A81 Abfahrt Stuttgart-Vaihingen über die B27.</p>'],
        ['kontakt_offhours_html', '<p>Außerhalb der Bürozeiten erreichen Sie uns jederzeit per E-Mail: <a href="mailto:info@ballonsport-krohmer.de">info@ballonsport-krohmer.de</a>. Wir antworten am nächsten Werktag.</p>'],

        // FAQ — neue Fragen 13–20
        ['faq_q13', 'Kann man auf einen Wunschort starten?'],
        ['faq_a13_html', '<p>Individuelle Startorte sind nach Rücksprache möglich, wenn der Ort geeignet ist. Sprechen Sie uns an.</p>'],

        ['faq_q14', 'Was passiert bei schlechtem Wetter?'],
        ['faq_a14_html', '<p>Bei ungeeignetem Wetter sagen wir ab und vergeben einen neuen Termin. Sie werden so früh wie möglich informiert.</p>'],

        ['faq_q15', 'Wie lange ist ein Gutschein gültig?'],
        ['faq_a15_html', '<p>Unsere Gutscheine haben eine großzügige Gültigkeitsdauer. Termin nach Verfügbarkeit — frühzeitig anfragen.</p>'],

        ['faq_q16', 'Kann man die Ballonfahrt fotografieren oder filmen?'],
        ['faq_a16_html', '<p>Ja, Smartphones und kompakte Kameras sind im Korb gut geeignet. Bitte sichern Sie Geräte mit einem Trageband.</p>'],

        ['faq_q17', 'Werden Speisen oder Getränke gereicht?'],
        ['faq_a17_html', '<p>Nach der Landung gibt es Champagner (für Kinder auch alkoholfrei) zur Ballon-Taufe. Speisen sind nicht enthalten.</p>'],

        ['faq_q18', 'Ist eine Ballonfahrt für Senioren geeignet?'],
        ['faq_a18_html', '<p>Grundsätzlich ja, viele ältere Gäste fahren mit. Voraussetzung: stehend im Korb bleiben und selbstständig einsteigen können.</p>'],

        ['faq_q19', 'Kann ich meinen Hund mitnehmen?'],
        ['faq_a19_html', '<p>Nein, Tiere dürfen aus luftfahrtrechtlichen Gründen nicht mit in den Korb.</p>'],

        ['faq_q20', 'Wo lande ich? Wie komme ich zurück?'],
        ['faq_a20_html', '<p>Der Landeplatz ist windabhängig. Unsere Begleitmannschaft holt Sie mit Fahrzeugen ab und bringt Sie zurück zum Startplatz (inklusive).</p>'],

        // Region-Landingpages
        ['region_stuttgart_title',     'Ballonfahrt Stuttgart und Umgebung'],
        ['region_stuttgart_desc',      'Heißluftballon fahren über Stuttgart — Ballonsport Krohmer aus Pliezhausen. Seit 1998.'],
        ['region_stuttgart_subtitle',  'Mit Ballonsport Krohmer über den Stuttgarter Kessel und die Schwäbische Alb schweben'],
        ['region_stuttgart_intro_html','<p>Stuttgart und Umgebung aus der Vogelperspektive — Ballonsport Krohmer bietet Ballonfahrten im Südraum Stuttgart und auf den Fildern an. Bitte anfragen für Verfügbarkeit.</p>'],

        ['region_reutlingen_title',     'Ballonfahrt Reutlingen'],
        ['region_reutlingen_desc',      'Heißluftballon fahren über Reutlingen und dem Alb-Trauf — Ballonsport Krohmer aus Pliezhausen.'],
        ['region_reutlingen_subtitle',  'Über Reutlingen, den Alb-Trauf und die Schwäbische Alb — mit Ballonsport Krohmer'],
        ['region_reutlingen_intro_html','<p>Reutlingen liegt am Fuß des Albtraufs — ein idealer Ausgangspunkt für Ballonfahrten. Ballonsport Krohmer ist in Pliezhausen zu Hause, nur wenige Kilometer entfernt.</p>'],

        ['region_tuebingen_title',     'Ballonfahrt Tübingen'],
        ['region_tuebingen_desc',      'Heißluftballon fahren über Tübingen, dem Neckar und der Schwäbischen Alb — Ballonsport Krohmer aus Pliezhausen.'],
        ['region_tuebingen_subtitle',  'Über Tübingen, den Neckar und die Alb — mit Ballonsport Krohmer in die Lüfte'],
        ['region_tuebingen_intro_html','<p>Tübingen aus der Luft — mit Blick auf Schloss Hohentübingen, Stiftskirche und Neckartal. Ballonsport Krohmer startet im Tübinger Raum.</p>'],

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

<h3>Angaben gemäß § 5 DDG</h3>
<p>
  <strong>Ballonsport Krohmer</strong><br>
  Inhaber: Günter Krohmer<br>
  Carl-Zeiss-Straße 3<br>
  72124 Pliezhausen<br>
  Deutschland
</p>

<h3>Kontakt</h3>
<p>
  Telefon: +49 (0) 7127 / 21173<br>
  Fax: +49 (0) 7127 / 1809-11<br>
  E-Mail: <a href="mailto:info@ballonsport-krohmer.de">info@ballonsport-krohmer.de</a>
</p>

<h3>Umsatzsteuer-Identifikationsnummer</h3>
<p>
  USt-IdNr. gemäß § 27 a UStG:<br>
  DE201806158
</p>

<h3>Verantwortlich für den Inhalt nach § 18 Abs. 2 MStV</h3>
<p>
  Günter Krohmer<br>
  Carl-Zeiss-Straße 3<br>
  72124 Pliezhausen
</p>

<h3>Aufsichtsbehörde</h3>
<p>
  Für luftrechtliche Belange (Luftverkehrsgesetz, LuftVG):<br>
  <strong>Luftfahrt-Bundesamt (LBA)</strong><br>
  Hermann-Blenk-Straße 26, 38108 Braunschweig<br>
  <a href="https://www.lba.de" target="_blank" rel="noopener noreferrer">www.lba.de</a>
</p>
<p>
  Ballonsport Krohmer ist ein genehmigtes Luftfahrtunternehmen.
</p>

<h3>Berufsbezeichnung</h3>
<p>
  Heißluftballonführer (Berufsausübung gemäß deutscher Luftverkehrsordnung,
  Lizenz erteilt in der Bundesrepublik Deutschland).
</p>

<h3>Online-Streitbeilegung (OS)</h3>
<p>
  Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung
  bereit:<br>
  <a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener noreferrer">https://ec.europa.eu/consumers/odr/</a>
</p>
<p>
  Unsere E-Mail-Adresse finden Sie oben im Impressum.
</p>

<h3>Verbraucherstreitbeilegung / Universalschlichtungsstelle</h3>
<p>
  Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer
  Verbraucherschlichtungsstelle teilzunehmen.
</p>

<h3>Haftung für Inhalte</h3>
<p>
  Als Diensteanbieter sind wir gemäß § 7 Abs. 1 DDG für eigene Inhalte auf
  diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10
  DDG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder
  gespeicherte fremde Informationen zu überwachen oder nach Umständen zu
  forschen, die auf eine rechtswidrige Tätigkeit hinweisen.
</p>

<h3>Haftung für Links</h3>
<p>
  Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte
  wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch
  keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der
  jeweilige Anbieter oder Betreiber verantwortlich.
</p>

<h3>Urheberrecht</h3>
<p>
  Die durch den Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten
  unterliegen dem deutschen Urheberrecht. Vervielfältigung, Bearbeitung,
  Verbreitung und jede Art der Verwertung außerhalb der Grenzen des
  Urheberrechts bedürfen der schriftlichen Zustimmung des jeweiligen Autors
  bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten,
  nicht kommerziellen Gebrauch gestattet.
</p>'],

        // Datenschutz
        ['datenschutz_html', '<h2>Datenschutzerklärung</h2>

<p><em>Stand: Mai 2026</em></p>

<h3>1. Verantwortlicher</h3>
<p>
  Verantwortlicher im Sinne der Datenschutz-Grundverordnung (DSGVO):<br>
  <strong>Günter Krohmer</strong>, Ballonsport Krohmer<br>
  Carl-Zeiss-Straße 3, 72124 Pliezhausen, Deutschland<br>
  Telefon: +49 (0) 7127 / 21173<br>
  E-Mail: <a href="mailto:info@ballonsport-krohmer.de">info@ballonsport-krohmer.de</a>
</p>

<h3>2. Allgemeines zur Datenverarbeitung</h3>
<p>
  Wir nehmen den Schutz Ihrer personenbezogenen Daten ernst. Personenbezogene
  Daten sind Informationen, die sich auf eine identifizierte oder
  identifizierbare natürliche Person beziehen. Wir verarbeiten Ihre Daten nur
  im Rahmen der gesetzlichen Vorschriften, insbesondere der DSGVO und des
  Bundesdatenschutzgesetzes (BDSG).
</p>

<h3>3. Erhebung von Daten beim Aufruf der Website (Server-Logs)</h3>
<p>
  Beim Aufruf unserer Website werden durch den Webserver automatisch folgende
  Daten in Server-Logdateien gespeichert:
</p>
<ul>
  <li>IP-Adresse des anfragenden Rechners (gekürzt, sofern technisch möglich)</li>
  <li>Datum und Uhrzeit des Zugriffs</li>
  <li>Name und URL der abgerufenen Datei</li>
  <li>Website, von der aus der Zugriff erfolgt (Referrer-URL)</li>
  <li>Verwendeter Browser und ggf. das Betriebssystem</li>
</ul>
<p>
  Diese Daten werden ausschließlich zur Sicherstellung eines störungsfreien
  Betriebs der Website, zur Abwehr von Angriffen sowie zur statistischen
  Auswertung im aggregierten Format genutzt. Rechtsgrundlage ist
  Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an einem sicheren
  Website-Betrieb). Die Logdaten werden nach spätestens <strong>7 Tagen</strong>
  gelöscht, sofern keine sicherheitsrelevante Auswertung erforderlich ist.
</p>

<h3>4. Hosting</h3>
<p>
  Unsere Website wird bei einem Anbieter in Deutschland gehostet. Der Hoster
  verarbeitet die oben genannten Server-Log-Daten als Auftragsverarbeiter in
  unserem Auftrag (Art. 28 DSGVO). Mit dem Hoster besteht ein Vertrag zur
  Auftragsverarbeitung.
</p>

<h3>5. Cookies und Sitzungen</h3>
<p>
  Diese Website verwendet ausschließlich <strong>technisch notwendige Cookies</strong>,
  die für den Betrieb des Angebots erforderlich sind (insbesondere für den
  Admin-Bereich). Diese Cookies enthalten keine personenbezogenen Daten und
  werden spätestens beim Schließen des Browsers gelöscht. Eine Einwilligung
  ist hierfür nicht erforderlich (§ 25 Abs. 2 TDDDG; Art. 6 Abs. 1 lit. f DSGVO).
</p>
<p>
  Wir verwenden <strong>kein Tracking</strong>, kein Google Analytics, kein
  Facebook-Pixel und keine vergleichbaren Marketing-Cookies. Aus diesem Grund
  benötigen wir auch keinen Cookie-Banner.
</p>

<h3>6. Schriftarten (Self-Hosted)</h3>
<p>
  Unsere Website nutzt die Schriftarten „Inter" und „Playfair Display".
  Diese werden ausschließlich von unserem eigenen Server geladen
  (<em>Self-Hosting</em>). Es besteht <strong>keine Verbindung zu Google Fonts
  oder anderen Drittanbietern</strong>; Ihre IP-Adresse wird beim Laden der
  Schriftarten nicht an externe Server übertragen.
</p>

<h3>7. Eingebettete Karte (OpenStreetMap)</h3>
<p>
  Auf unserer <a href="/kontakt.php">Kontaktseite</a> binden wir eine
  Kartenansicht von OpenStreetMap ein. OpenStreetMap wird betrieben von der
  OpenStreetMap Foundation, St John\'s Innovation Centre, Cowley Road,
  Cambridge, CB4 0WS, Vereinigtes Königreich.
</p>
<p>
  Beim Aufruf der Kontaktseite wird die Karte erst dann geladen, wenn Sie zu
  ihr scrollen (<em>Lazy Loading</em>). Bei der Anzeige werden Daten
  (insbesondere Ihre IP-Adresse) an OpenStreetMap übermittelt. Rechtsgrundlage
  ist Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an einer
  benutzerfreundlichen Anfahrtsbeschreibung). Weitere Informationen finden Sie
  in der Datenschutzerklärung von OpenStreetMap:
  <a href="https://wiki.osmfoundation.org/wiki/Privacy_Policy" target="_blank" rel="noopener noreferrer">wiki.osmfoundation.org/wiki/Privacy_Policy</a>.
</p>

<h3>8. Kontaktformular und E-Mail-Kontakt</h3>
<p>
  Wenn Sie uns per Kontaktformular oder E-Mail kontaktieren, werden Ihre
  angegebenen Daten (Name, E-Mail-Adresse, ggf. Telefonnummer, Nachricht und
  Betreff) zur Bearbeitung Ihrer Anfrage und für eventuelle Anschlussfragen
  bei uns gespeichert. Rechtsgrundlage ist Art. 6 Abs. 1 lit. b DSGVO
  (Vertragsanbahnung) bzw. Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse
  an der Beantwortung von Anfragen).
</p>
<p>
  Diese Daten werden nach abschließender Bearbeitung Ihrer Anfrage gelöscht,
  sofern keine gesetzlichen Aufbewahrungspflichten bestehen (insbesondere
  steuer- und handelsrechtliche Aufbewahrungspflichten von 6 bzw. 10 Jahren
  bei Vertragsabschluss).
</p>

<h3>9. Datenweitergabe an Dritte</h3>
<p>
  Wir geben Ihre personenbezogenen Daten <strong>nicht an Dritte</strong>
  weiter, es sei denn, Sie haben ausdrücklich eingewilligt, die Weitergabe ist
  zur Vertragserfüllung erforderlich (z. B. an Versicherungen im Schadensfall)
  oder wir sind gesetzlich zur Weitergabe verpflichtet.
</p>

<h3>10. Speicherdauer</h3>
<p>
  Personenbezogene Daten werden nur so lange gespeichert, wie es zur Erfüllung
  des jeweiligen Zwecks erforderlich ist oder gesetzliche Aufbewahrungsfristen
  bestehen. Nach Wegfall des Zwecks werden die Daten gelöscht.
</p>

<h3>11. Ihre Rechte als betroffene Person</h3>
<p>Sie haben gemäß Art. 15–21 DSGVO folgende Rechte:</p>
<ul>
  <li><strong>Auskunftsrecht</strong> (Art. 15 DSGVO): Sie können Auskunft über die zu Ihrer Person gespeicherten Daten verlangen.</li>
  <li><strong>Recht auf Berichtigung</strong> (Art. 16 DSGVO): Sie können die Berichtigung unrichtiger Daten verlangen.</li>
  <li><strong>Recht auf Löschung</strong> (Art. 17 DSGVO): Sie können unter bestimmten Voraussetzungen die Löschung Ihrer Daten verlangen.</li>
  <li><strong>Recht auf Einschränkung der Verarbeitung</strong> (Art. 18 DSGVO)</li>
  <li><strong>Recht auf Datenübertragbarkeit</strong> (Art. 20 DSGVO)</li>
  <li><strong>Widerspruchsrecht</strong> (Art. 21 DSGVO): Sie können der Verarbeitung Ihrer Daten widersprechen.</li>
  <li><strong>Widerrufsrecht bei Einwilligungen</strong> (Art. 7 Abs. 3 DSGVO)</li>
</ul>
<p>
  Zur Ausübung Ihrer Rechte wenden Sie sich bitte per E-Mail an
  <a href="mailto:info@ballonsport-krohmer.de">info@ballonsport-krohmer.de</a>
  oder schriftlich an die im Impressum genannte Anschrift.
</p>

<h3>12. Beschwerderecht bei der Aufsichtsbehörde</h3>
<p>
  Sie haben das Recht, sich bei einer Datenschutz-Aufsichtsbehörde über die
  Verarbeitung Ihrer personenbezogenen Daten zu beschweren. Die für uns
  zuständige Aufsichtsbehörde ist:
</p>
<p>
  <strong>Landesbeauftragter für den Datenschutz und die Informationsfreiheit
  Baden-Württemberg (LfDI BW)</strong><br>
  Postfach 10 29 32, 70025 Stuttgart<br>
  <a href="https://www.baden-wuerttemberg.datenschutz.de" target="_blank" rel="noopener noreferrer">www.baden-wuerttemberg.datenschutz.de</a>
</p>

<h3>13. Datensicherheit (SSL/TLS)</h3>
<p>
  Diese Website nutzt aus Sicherheitsgründen und zum Schutz der Übertragung
  vertraulicher Inhalte eine SSL- bzw. TLS-Verschlüsselung. Eine verschlüsselte
  Verbindung erkennen Sie daran, dass die Adresszeile des Browsers von
  „http://" auf „https://" wechselt und am Schloss-Symbol in der Browserzeile.
</p>

<h3>14. Aktualität und Änderung dieser Datenschutzerklärung</h3>
<p>
  Wir behalten uns vor, diese Datenschutzerklärung anzupassen, damit sie stets
  den aktuellen rechtlichen Anforderungen entspricht. Die jeweils aktuelle
  Fassung gilt für Ihren nächsten Besuch unserer Website.
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
