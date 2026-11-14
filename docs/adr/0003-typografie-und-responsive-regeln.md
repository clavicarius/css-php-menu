# ADR 0003: Typografie und responsive Regeln

- Status: Angenommen; lokale Fontdateien ausstehend
- Datum: 2026-11-14

## Kontext

Das Erscheinungsbild soll klassische Serifenschriften mit gut lesbarer
serifenloser Schrift kombinieren. Die Website soll ohne externe Fontdienste
funktionieren und auf kleinen und großen Viewports lesbar bleiben.

## Entscheidung

Überschriften verwenden Cormorant Garamond; Fließtext, Navigation und
Bedienelemente verwenden Source Sans 3. Schriftdeklarationen erwarten lokal
gehostete WOFF2-Dateien unter `assets/fonts/`, setzen `font-display: swap` und
definieren System-Fallbacks. Es wird keine Verbindung zu Google Fonts oder
anderen externen Schrift-CDNs hergestellt.

Schriftgrößen liegen zentral in `css/tokens/typography.css` und verwenden
`clamp()` für fließende Skalierung. Abstände und Inhaltsbreite werden zentral in
`css/tokens/spacing.css` gepflegt. Komponenten definieren keine eigenständige
responsive Typografieskala.

## Folgen und offene Punkte

- Die erwarteten Fontdateien müssen vor der produktiven Einbindung bereitgestellt
  werden. Ihr Lizenzumfang, Dateinamen und geladene Schnitte sind vor dem
  Einchecken zu prüfen.
- Bis dahin greifen die System-Fallbacks; die Gestaltung kann deshalb
  typografisch abweichen.
- Änderungen an den Schriftschnitten oder Skalen erfolgen zentral und sind auf
  schmalen und breiten Viewports zu überprüfen.
- Die konkreten Schriftgrößen sind ein Startsystem und können anhand echter
  Inhalte weiterentwickelt werden.
