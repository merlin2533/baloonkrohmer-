<?php
/**
 * Migration v1.3 — Impressum und Datenschutz auf aktuellen Rechtsstand.
 *
 * Was wird aktualisiert?
 *  - Impressum: § 18 Abs. 2 MStV (ersetzt § 55 Abs. 2 RStV seit 2020),
 *    DDG (ersetzt TMG seit Mai 2024), Aufsichtsbehörde Luftfahrt-Bundesamt
 *    für luftrechtliche Tätigkeit, Berufsbezeichnung, Haftungs- und
 *    Urheberhinweis.
 *  - Datenschutz: präzisierte Server-Log-Aufbewahrung, Hosting in
 *    Deutschland (Auftragsverarbeitung), eingebettete OpenStreetMap-Karte,
 *    Self-Hosted Fonts (positiv: keine Google Fonts), Klarstellung kein
 *    Tracking, kein Cookie-Banner nötig, Aktualisierungsdatum.
 *
 * Aufruf:  php bin/v13-legal-update.php
 * Idempotent — kann beliebig oft laufen.
 */

require __DIR__ . '/../src/bootstrap.php';

$impressum = <<<'HTML'
<h2>Impressum</h2>

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
</p>
HTML;

$datenschutz = <<<'HTML'
<h2>Datenschutzerklärung</h2>

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
  OpenStreetMap Foundation, St John's Innovation Centre, Cowley Road,
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
</p>
HTML;

set_content('impressum_html', $impressum);
set_content('datenschutz_html', $datenschutz);

echo "Impressum + Datenschutz aktualisiert (rechtskonform DDG/MStV/DSGVO).\n";
echo "v1.3 Migration abgeschlossen.\n";
