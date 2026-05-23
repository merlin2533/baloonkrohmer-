Schriftdateien für Ballonsport Krohmer
=======================================

Dieses Verzeichnis ist für selbst-gehostete Schriftdateien vorgesehen.

Benötigte Schriften:
  1. Inter (Variable Font oder Gewichte 400, 500, 600, 700)
     Quelle: https://rsms.me/inter/ (SIL Open Font License)
     Dateinamen: inter-400.woff2, inter-500.woff2, inter-600.woff2, inter-700.woff2

  2. Playfair Display (Gewichte 400, 700)
     Quelle: https://fonts.google.com/specimen/Playfair+Display (SIL Open Font License)
     Dateinamen: playfair-400.woff2, playfair-700.woff2

Solange die Dateien fehlen, greift das CSS auf den Fallback zurück:
  --font-sans:    Inter, system-ui, -apple-system, sans-serif
  --font-display: "Playfair Display", Georgia, "Times New Roman", serif

Schriften NICHT von Google Fonts laden (Datenschutz, DSGVO).
Stattdessen woff2-Dateien von den oben genannten Quellen herunterladen
und in dieses Verzeichnis ablegen. Anschließend in styles.css die
@font-face-Regeln einkommentieren.
