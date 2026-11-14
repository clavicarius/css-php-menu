# ADR 0004: Komponenten und Wartbarkeit

- Status: Angenommen
- Datum: 2026-11-14

## Kontext

Navigation, Footer und Bedienelemente benötigen wiedererkennbare Stile, ohne
die zentralen Gestaltungsregeln zu umgehen. Tastaturbedienung und
Bewegungssensibilität sind Teil der zugänglichen Umsetzung.

## Entscheidung

Wiederverwendbare Stile werden in `css/components/` nach Komponente organisiert.
Komponenten konsumieren semantische Farben, Typografie-, Abstands- und
Effekt-Tokens; sie führen keine konkurrierenden Farbpaletten ein.

Fokus ist über `:focus-visible` sichtbar. Bewegungsreduktion wird mit
`prefers-reduced-motion` berücksichtigt. Interaktive Ziele sollen ausreichend
groß sein; die bereitgestellte Button-Komponente nutzt eine Mindesthöhe von
2,75rem. Status und Interaktionszustände müssen außer durch Farbe auch durch
Text, Form oder ein anderes erkennbares Signal verständlich sein.

## Folgen und offene Punkte

- Neue Komponenten sollen die bestehenden Tokens und Zustandsmuster nutzen.
- Vor dem Ergänzen komponentenspezifischer Werte ist zu prüfen, ob ein zentraler
  Token die richtige Abstraktion ist.
- Geänderte Farb- oder Fokuszustände müssen auf Kontrast und Tastaturbedienung
  überprüft werden.
- Bei Designänderungen sind `css/main.css`, README und die betroffenen ADRs
  konsistent zu halten.
