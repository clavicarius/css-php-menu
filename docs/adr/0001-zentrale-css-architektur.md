# ADR 0001: Zentrale CSS-Architektur

- Status: Angenommen
- Datum: 2026-11-14

## Kontext

Die Website benötigt über Seiten und Komponenten hinweg ein einheitliches,
wartbares Erscheinungsbild. Einzelne Komponenten sollen Farben, Typografie und
andere Gestaltungswerte nicht unabhängig voneinander pflegen.

## Entscheidung

`css/main.css` ist der Einstiegspunkt für das vollständige Designsystem. Es importiert zuerst
Design-Tokens, danach Basisstile und zuletzt Komponenten. Globale Entwurfswerte
liegen in `css/tokens/`; Reset und globale Regeln in `css/base/`; wiederverwendbare
Komponentenstile in `css/components/`.

Konkrete Werte werden als primitive Tokens definiert. Komponenten greifen über
semantische Custom Properties auf die Werte zu, beispielsweise
`--color-primary` statt eines direkt notierten Hex-Werts. Für eine unabhängige
Einbindung importiert `css/menu.css` nur Navigation und Footer. Diese Komponenten
haben Fallbackwerte für die verwendeten Tokens, sodass sie ohne die globalen
Styles und Schriften der Beispielseite funktionieren.

## Folgen und offene Punkte

- Eine zentrale Änderung an einem Token kann das Erscheinungsbild aller
  zugeordneten Komponenten ändern.
- Neue CSS-Dateien müssen über `css/main.css` eingebunden werden.
- Für Navigation und Footer kann stattdessen `css/menu.css` eingebunden werden.
- Neue Entwurfswerte werden zentral hinzugefügt und semantisch zugeordnet;
  verstreute, komponentenspezifische Farbdefinitionen sind zu vermeiden.
- Die Ordnerstruktur darf bei Bedarf wachsen, ohne den zentralen Einstiegspunkt
  oder die Trennung von Tokens, Basis und Komponenten aufzugeben.
