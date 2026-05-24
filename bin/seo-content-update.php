<?php
/**
 * Ballonsport Krohmer — SEO-Content-Update
 *
 * Schreibt alle neuen SEO-relevanten Content-Keys idempotent in die DB.
 * Kann beliebig oft ausgeführt werden (INSERT OR IGNORE + UPDATE).
 *
 * Aufruf: php bin/seo-content-update.php
 */

declare(strict_types=1);

if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}

require ROOT . '/src/bootstrap.php';

$updates = [

    // =========================================================================
    // STARTSEITE — Region-Block
    // =========================================================================
    'home_region_html' => '<p>Die Schwäbische Alb ist unsere Heimat — und seit 1998 das Revier unserer Heißluftballone. Von <strong>Pliezhausen</strong> aus, direkt zwischen Tübingen und Reutlingen gelegen, starten wir in die Lüfte über einer der schönsten Mittelgebirgslandschaften Deutschlands.</p>
<p>Unsere Startorte reichen von <strong>Reutlingen</strong> und <strong>Tübingen</strong> über den <strong>Südraum Stuttgart</strong> bis nach <strong>Balingen</strong> und <strong>Hechingen</strong>. Die Windrichtung entscheidet, wohin die Fahrt geht — genau das macht eine Ballonfahrt so besonders: Kein Kurs ist wie der andere.</p>
<p>Ob Sonnenaufgangsfahrt über dem morgendlichen Nebel oder Abendfahrt mit goldenem Licht auf der Alb-Hochfläche — die Region bietet zu jeder Jahreszeit und jeder Tageszeit atemberaubende Ausblicke. Wir zeigen Ihnen Ihre Heimat aus einer Perspektive, die Sie nie vergessen werden.</p>',

    // =========================================================================
    // STARTSEITE — Was Sie erwartet
    // =========================================================================
    'home_erwartet_html' => '<p>Eine Ballonfahrt bei Ballonsport Krohmer dauert insgesamt vier bis fünf Stunden — die Flugzeit beträgt etwa eineinhalb Stunden. Das klingt nach viel, aber jede Phase gehört dazu:</p>
<ol style="list-style:decimal;padding-left:1.5em;margin:1rem 0">
  <li style="margin-bottom:.5rem"><strong>Begrüßung &amp; Wetter-Briefing</strong> — Pilot Günter Krohmer erklärt die Windlage und den geplanten Kurs.</li>
  <li style="margin-bottom:.5rem"><strong>Aufrüsten des Ballons</strong> — gemeinsam mit der Crew, Kinder und Neugierige dürfen helfen.</li>
  <li style="margin-bottom:.5rem"><strong>Start</strong> — langsam hebt der Korb ab, die Erde gleitet nach unten.</li>
  <li style="margin-bottom:.5rem"><strong>Ca. 1,5 h Fahrt</strong> — lautlos, wind-getragen, mit Blick über Alb, Täler und Städte.</li>
  <li style="margin-bottom:.5rem"><strong>Landung</strong> — der Pilot wählt eine geeignete Fläche, die Crew holt Sie ab.</li>
  <li style="margin-bottom:.5rem"><strong>Champagner-Taufe</strong> — das traditionelle Ballon-Ritual mit Urkunde für jeden Passagier.</li>
  <li><strong>Rücktransport</strong> — mit der Begleitfahrzeugen zurück zum Startplatz.</li>
</ol>',

    // =========================================================================
    // BALLONFAHREN — Ablauf
    // =========================================================================
    'ballonfahren_ablauf_html' => '<p>Eine Ballonfahrt ist mehr als die reine Flugzeit. So läuft Ihr Tag mit Ballonsport Krohmer ab:</p>
<ol style="list-style:decimal;padding-left:1.5em;margin:1rem 0">
  <li style="margin-bottom:.75rem"><strong>Treffpunkt &amp; Begrüßung</strong><br>Etwa 30 Minuten vor dem geplanten Start treffen wir uns am vereinbarten Platz. Der Pilot informiert über Wetter, Wind und Ablauf.</li>
  <li style="margin-bottom:.75rem"><strong>Wetter-Check</strong><br>Wir prüfen die Windverhältnisse nochmals live. Nur bei stabiler, sicherer Wetterlage starten wir — das Wohl unserer Gäste geht vor.</li>
  <li style="margin-bottom:.75rem"><strong>Ballon aufrüsten</strong><br>Hülle auslegen, Korb aufstellen, Gebläse anwerfen. Wer möchte, kann dabei helfen — ein Erlebnis für sich.</li>
  <li style="margin-bottom:.75rem"><strong>Einsteigen &amp; Start</strong><br>Der Pilot gibt das Zeichen. Das Brennerfeuer erhitzt die Luft in der Hülle — und schon hebt der Korb ab.</li>
  <li style="margin-bottom:.75rem"><strong>Die Fahrt — ca. 1,5 Stunden</strong><br>Lautlos gleiten Sie über Täler, Dörfer und Wälder. Die Höhe variiert zwischen 300 und 1500 Metern. Der Wind bestimmt die Richtung, der Pilot die Höhe.</li>
  <li style="margin-bottom:.75rem"><strong>Landung</strong><br>Der Pilot sucht eine geeignete Landestelle aus. Die Begleitfahrzeuge folgen am Boden. Die Landung ist sanft — Ihre einzige Aufgabe: Knie leicht beugen.</li>
  <li style="margin-bottom:.75rem"><strong>Ballon-Taufe mit Champagner</strong><br>Eine alte Tradition: Nach der Landung werden alle Passagiere getauft und erhalten eine persönliche Urkunde.</li>
  <li><strong>Rücktransport zum Startplatz</strong><br>Die Crew bringt Sie mit den Begleitfahrzeugen zurück. Gesamtzeit: 4–5 Stunden.</li>
</ol>',

    // =========================================================================
    // BALLONFAHREN — Aussicht
    // =========================================================================
    'ballonfahren_aussicht_html' => '<p>Je nach Windrichtung und Startort eröffnen sich ganz unterschiedliche Panoramen. Das sind die Highlights, die unsere Passagiere am häufigsten beschreiben:</p>
<ul style="list-style:disc;padding-left:1.5em;margin:1rem 0">
  <li style="margin-bottom:.5rem"><strong>Burg Hohenzollern</strong> — bei guter Sicht überragt der Stammburg der Hohenzollern den Albrand, eine der eindrucksvollsten Silhouetten Südwestdeutschlands.</li>
  <li style="margin-bottom:.5rem"><strong>Schloss Lichtenstein</strong> — romantisch auf einem Felssporn über dem Echaztal, besonders beeindruckend aus der Vogelperspektive.</li>
  <li style="margin-bottom:.5rem"><strong>Reutlinger Alb-Trauf</strong> — der steile Abbruch der Schwäbischen Alb nach Norden, darunter die Ausläufer der Stadt Reutlingen.</li>
  <li style="margin-bottom:.5rem"><strong>Filderebene und Stuttgart-Kessel</strong> — bei Nordwind geht die Fahrt über die Filder, und der Stuttgarter Talkessel mit seiner Stadtsilhouette taucht am Horizont auf.</li>
  <li style="margin-bottom:.5rem"><strong>Neckartal und Tübingen</strong> — das Neckartal mit Tübingens Schloss und Stiftskirche ist aus der Luft ein besonderes Motiv.</li>
  <li><strong>Alpen-Panorama</strong> — an klaren Tagen, vor allem im Herbst und Winter, reicht die Sicht bis zu den Alpen.</li>
</ul>
<p>Was Sie konkret sehen, hängt von Wind und Wetter ab — das macht jede Fahrt einzigartig.</p>',

    // =========================================================================
    // UNSERE BALLONE — Technik
    // =========================================================================
    'ballone_technik_html' => '<p>Ein Heißluftballon besteht aus drei Hauptteilen: der Hülle (dem "Ballon"), dem Brenner und dem Korb. Das Prinzip ist einfach — und doch faszinierend:</p>
<p>Die Hülle aus besonders leichtem, beschichtetem Nylon oder Polyester fasst mehrere tausend Kubikmeter Luft. Der Brenner erhitzt diese Luft auf 80 bis 120 °C — heiße Luft ist leichter als kalte Luft und erzeugt so Auftrieb. Je mehr der Pilot den Brenner einsetzt, desto höher steigt der Ballon. Durch Kühlen (Brenner aus) sinkt er wieder.</p>
<p>Die Fahrtrichtung wird allein vom Wind bestimmt. Der Pilot kann jedoch die Höhe wechseln, um Windschichten mit unterschiedlicher Richtung zu nutzen — das macht Ballonfliegen zu einer echten Kunst.</p>
<p>Die Landesituation wählt der Pilot sorgfältig aus: ein freies Feld, idealerweise in der Nähe einer Straße, damit die Begleitmannschaft mit den Fahrzeugen helfen kann. Unsere Ballone sind nach den strengen Vorschriften der Luftfahrtbehörden zugelassen und werden regelmäßig gewartet.</p>',

    // =========================================================================
    // PREISE — Im Preis enthalten
    // =========================================================================
    'preise_included_html' => '<ul style="list-style:disc;padding-left:1.5em;margin:0">
  <li>Sicherheits-Briefing vor dem Start</li>
  <li>Ca. 1,5 Stunden Ballonfahrt</li>
  <li>Passagier-Haftpflicht- und Unfallversicherung</li>
  <li>Champagner (oder Saft für Kinder) nach der Landung</li>
  <li>Traditionelle Ballonfahrer-Taufe</li>
  <li>Persönliche Ballonfahrer-Urkunde</li>
  <li>Rücktransport zum Startplatz mit dem Begleitfahrzeug</li>
</ul>
<p style="margin-top:1rem"><strong>Nicht enthalten:</strong> An- und Abreise zum Startplatz, persönliche Getränke während der Fahrt (außer nach der Landung), optionale Rahmenprogramme.</p>',

    // =========================================================================
    // PREISE — Gruppen
    // =========================================================================
    'preise_gruppe_html' => '<p>Für Gruppen ab 6 Personen stellen wir individuelle Angebote zusammen. Bei sehr großen Gruppen können wir bis zu vier Ballone gleichzeitig einsetzen — das macht bis zu 25 Passagiere auf einmal möglich.</p>
<p>Was sich ändert: Bei Gruppenfahrten stimmen wir Startzeit, Logistik und eventuell einen Rahmenprogramm-Abend gezielt auf Ihre Bedürfnisse ab. Sprechen Sie uns an — wir finden eine Lösung.</p>
<p><a href="/kontakt.php?betreff=Gruppenfahrt" class="btn btn-ghost" style="margin-top:.5rem">Gruppenanfrage stellen</a></p>',

    // =========================================================================
    // PREISE — Gutschein Detail
    // =========================================================================
    'preise_gutschein_detail_html' => '<p>Ein Ballonfahrt-Gutschein ist das Erlebnisgeschenk schlechthin — für runde Geburtstage, Hochzeitstage, Jubiläen oder einfach als Dankeschön für Menschen, die man schätzt.</p>
<p><strong>So erhalten Sie Ihren Gutschein:</strong> Rufen Sie uns während der Bürozeiten an oder schreiben Sie uns eine E-Mail. Wir stellen den Gutschein auf Wunsch auf einen Namen aus und senden ihn Ihnen zu.</p>
<p><strong>Einlösung:</strong> Der Gutschein ist lange gültig — Termin nach Verfügbarkeit, abhängig von Wetter und freien Plätzen. Am besten frühzeitig einen Wunschzeitraum nennen.</p>
<p><strong>Anlässe, für die unsere Gutscheine besonders beliebt sind:</strong></p>
<ul style="list-style:disc;padding-left:1.5em;margin:.5rem 0 1rem">
  <li>Hochzeitstag &amp; Jahrestag</li>
  <li>Runder Geburtstag</li>
  <li>Firmen-Jubiläum</li>
  <li>Abschluss &amp; Ruhestand</li>
  <li>Muttertag / Vatertag</li>
  <li>Weihnachten</li>
</ul>
<p><a href="/kontakt.php?betreff=Gutschein" class="btn btn-primary">Gutschein anfragen</a></p>',

    // =========================================================================
    // KONTAKT — Anfahrt
    // =========================================================================
    'kontakt_anfahrt_html' => '<p>Pliezhausen liegt direkt zwischen Tübingen und Reutlingen, etwa 15 km südlich von Stuttgart.</p>
<p><strong>Von der Autobahn A8</strong> (Stuttgart–Ulm): Abfahrt Denkendorf oder Kirchheim-West, dann über die B297 Richtung Reutlingen, weiter nach Pliezhausen.</p>
<p><strong>Von der A81</strong> (Stuttgart–Singen): Abfahrt Stuttgart-Vaihingen, dann über die B27 Richtung Tübingen, Abfahrt Pliezhausen.</p>
<p><strong>Aus Reutlingen:</strong> ca. 10 Minuten über die L230 Richtung Pliezhausen.</p>
<p><strong>Aus Tübingen:</strong> ca. 15 Minuten über die B28 Richtung Reutlingen, dann Pliezhausen ausgeschildert.</p>',

    // =========================================================================
    // KONTAKT — Außerhalb Bürozeiten
    // =========================================================================
    'kontakt_offhours_html' => '<p>Unsere Bürozeiten sind Mo–Do 8–12 Uhr und 14–17 Uhr sowie Fr 8–12 Uhr. Außerhalb dieser Zeiten können Sie uns jederzeit per E-Mail erreichen:</p>
<p><a href="mailto:info@ballonsport-krohmer.de"><strong>info@ballonsport-krohmer.de</strong></a></p>
<p>Wir antworten in der Regel am nächsten Werktag. Für Terminanfragen ist es hilfreich, wenn Sie Ihren Wunschzeitraum und die gewünschte Personenzahl direkt mitschreiben — dann können wir schnell und konkret antworten.</p>',

    // =========================================================================
    // FAQ — Neue Fragen 13–20
    // =========================================================================
    'faq_q13' => 'Kann man auf einen Wunschort starten?',
    'faq_a13_html' => '<p>Grundsätzlich ja — nach Rücksprache sind individuelle Startorte möglich. Allerdings muss der Ort geeignet sein: ausreichend Platz zum Aufrüsten, keine Hindernisse in Windrichtung, und die Begleitfahrzeuge müssen erreichbar sein. Sprechen Sie uns an, wir prüfen das gerne.</p>',

    'faq_q14' => 'Was passiert bei schlechtem Wetter?',
    'faq_a14_html' => '<p>Wir prüfen das Wetter sehr sorgfältig — sicherheitshalber lieber einen Termin mehr ab als einen zu früh durchgeführt. Bei Regen, starkem Wind (über 20 km/h) oder Gewittern sagen wir ab und vergeben einen neuen Termin. Sie werden so früh wie möglich informiert, idealerweise bereits am Vorabend.</p>',

    'faq_q15' => 'Wie lange ist ein Gutschein gültig?',
    'faq_a15_html' => '<p>Unsere Gutscheine haben eine großzügige Gültigkeitsdauer — der Termin wird nach Verfügbarkeit und Wetterlage vergeben. Genaueres erfahren Sie bei der Gutschein-Ausstellung. Wichtig: Bitte frühzeitig einen Wunschzeitraum nennen, da beliebte Zeiten (Frühjahr, Herbst) schnell ausgebucht sind.</p>',

    'faq_q16' => 'Kann man die Ballonfahrt fotografieren oder filmen?',
    'faq_a16_html' => '<p>Unbedingt! Die meisten Passagiere haben ihr Smartphone oder eine Kamera dabei. Im Korb ist gut Platz für Handys und kompakte Kameras. Größere Kamera-Ausrüstung ist nach Absprache möglich. Bitte sichern Sie Ihre Geräte mit einem Band oder Trageband — aus dem Korb Fallendes lässt sich nicht mehr bergen.</p>',

    'faq_q17' => 'Werden Speisen oder Getränke gereicht?',
    'faq_a17_html' => '<p>Nach der Landung gibt es traditionell Champagner zur Ballon-Taufe — für Kinder oder Nichttrinker selbstverständlich auch alkoholfrei. Speisen sind nicht Bestandteil der Fahrt. Wenn Sie wünschen, können Sie eigene Snacks mitbringen.</p>',

    'faq_q18' => 'Ist eine Ballonfahrt für Senioren geeignet?',
    'faq_a18_html' => '<p>Grundsätzlich ja — viele unserer begeisterten Passagiere sind über 70 Jahre alt. Voraussetzung: Man sollte die Fahrt stehend verbringen können und beim Einsteigen in den Korb (Korbrand ca. 1,10 m hoch) selbstständig oder mit kleiner Hilfe klarkommen. Bei gesundheitlichen Bedenken sprechen Sie bitte vorher mit Ihrem Arzt.</p>',

    'faq_q19' => 'Kann ich meinen Hund mitnehmen?',
    'faq_a19_html' => '<p>Nein, das ist leider nicht möglich. Tiere dürfen aus luftfahrtrechtlichen Gründen und aus Sicherheitsrücksicht nicht mit in den Korb. Wir bitten um Verständnis.</p>',

    'faq_q20' => 'Wo lande ich? Wie komme ich zurück?',
    'faq_a20_html' => '<p>Der Landeplatz hängt von Wind und Gelände ab und lässt sich nicht vorab exakt bestimmen — das ist das Abenteuerliche am Ballonfahren. Unsere Begleitmannschaft folgt mit Fahrzeugen am Boden und bringt Sie nach der Landung und der Taufe zurück zum Startplatz. Die Rückfahrt ist im Preis enthalten.</p>',

    // =========================================================================
    // REGION STUTTGART
    // =========================================================================
    'region_stuttgart_title'    => 'Ballonfahrt Stuttgart und Umgebung',
    'region_stuttgart_desc'     => 'Heißluftballon fahren über Stuttgart — Ballonsport Krohmer aus Pliezhausen. Seit 1998. Startorte im Stuttgarter Süden und auf den Fildern.',
    'region_stuttgart_subtitle' => 'Mit Ballonsport Krohmer über den Stuttgarter Kessel und die Schwäbische Alb schweben',
    'region_stuttgart_intro_html' => '<p>Stuttgart ist eine Stadt der Kontraste: Weinberge im Stadtgebiet, Kessel und Höhen, Neckar und Autobahnen — und das alles aus der Vogelperspektive zu sehen ist ein besonderes Erlebnis. Ballonsport Krohmer startet im Südraum Stuttgart und auf den Fildern, je nach Windlage auch direkt am Stadtrand.</p>
<p>Wir sind seit 1998 in der Region aktiv und kennen die Windverhältnisse rund um Stuttgart sehr gut. Besonders beliebt sind Fahrten bei Südwind, wenn der Ballon über die Weinberge des Remstals oder Richtung Neckar zieht. Bei Nordwind geht es über die Filderebene, mit Blick auf den Stuttgarter Fernsehturm und das Schlossar des Killesbergs.</p>
<p>Stuttgart-Gäste starten oft im Bereich Leinfelden-Echterdingen oder in den Gemeinden südlich der Stadt — immer abhängig von Wetter und Tageszeit. Morgens kurz nach Sonnenaufgang und abends zwei bis drei Stunden vor Sonnenuntergang sind die schönsten und windstillsten Startzeiten. Für einen Gutschein als Geschenk für Stuttgarter Freunde oder Kollegen stehen wir gerne zur Verfügung — rufen Sie einfach an.</p>',

    // =========================================================================
    // REGION REUTLINGEN
    // =========================================================================
    'region_reutlingen_title'    => 'Ballonfahrt Reutlingen',
    'region_reutlingen_desc'     => 'Heißluftballon fahren über Reutlingen und dem Alb-Trauf — Ballonsport Krohmer aus Pliezhausen. Einer der Haupt-Startorte seit 1998.',
    'region_reutlingen_subtitle' => 'Über Reutlingen, den Alb-Trauf und die Schwäbische Alb — mit Ballonsport Krohmer',
    'region_reutlingen_intro_html' => '<p>Reutlingen liegt direkt am Fuß des Albtraufs — dort, wo die Schwäbische Alb steil nach Norden in die Voralbebene abfällt. Kein Wunder, dass Reutlingen einer unserer wichtigsten Startorte ist: Kaum irgendwo bietet die Region so eindrucksvolle Ausblicke wie hier.</p>
<p>Wenn Sie von Reutlingen aus starten, steigt der Ballon über die Dächer der Stadt, passiert den Alb-Trauf und schwebt dann über der Hochfläche der Alb — mit Blick auf Burgen, Wälder und die weite Landschaft bis zum Horizont. Bei guter Sicht sind die Alpen zu erkennen.</p>
<p>Ballonsport Krohmer ist in Pliezhausen zu Hause — wenige Kilometer von Reutlingen entfernt. Das macht uns zum echten Regionalanbieter: kurze Wege, persönliche Betreuung, ein Pilot der die Gegend kennt wie seine eigene Haustür. Kontaktieren Sie uns für einen Termin in der Region Reutlingen — wir freuen uns auf Sie.</p>',

    // =========================================================================
    // REGION TÜBINGEN
    // =========================================================================
    'region_tuebingen_title'    => 'Ballonfahrt Tübingen',
    'region_tuebingen_desc'     => 'Heißluftballon fahren über Tübingen, dem Neckar und der Schwäbischen Alb — Ballonsport Krohmer aus Pliezhausen. Seit 1998.',
    'region_tuebingen_subtitle' => 'Über Tübingen, den Neckar und die Alb — mit Ballonsport Krohmer in die Lüfte',
    'region_tuebingen_intro_html' => '<p>Tübingen ist eine der schönsten Universitätsstädte Deutschlands — und aus der Luft betrachtet noch beeindruckender als zu Fuß. Schloss Hohentübingen, die Stiftskirche, der Neckar-Bogen und die bunten Fachwerkhäuser der Altstadt bilden ein Panorama, das man so schnell nicht vergisst.</p>
<p>Unsere Ballone starten im Raum Tübingen häufig in den frühen Morgenstunden, wenn der Wind schwach und die Luft klar ist. Dann liegt noch Morgennebel in den Tälern, während der Ballon bereits im Sonnenlicht schwebt — ein Erlebnis, das viele Passagiere als das schönste ihres Lebens bezeichnen.</p>
<p>Pliezhausen, unser Heimatstandort, liegt nur rund 10 Kilometer von Tübingen entfernt — zwischen Tübingen und Reutlingen, direkt am Eingang zur Schwäbischen Alb. Das macht uns zum idealen Anbieter für Ballonfahrten im Tübinger Raum. Termine per Telefon oder E-Mail — wir freuen uns auf Ihre Nachricht.</p>',

];

$count = 0;
foreach ($updates as $key => $value) {
    set_content($key, $value);
    $count++;
    echo "  ✓ {$key}\n";
}

echo "\nFertig: {$count} Content-Keys gesetzt.\n";
