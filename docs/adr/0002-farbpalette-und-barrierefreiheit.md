# ADR 0002: Farbpalette und Barrierefreiheit

- Status: Angenommen; Palette und konkrete Markenwerte vorläufig
- Datum: 2026-11-14

## Kontext

Die gestalterische Richtung verbindet Bordeaux, Elfenbein, Gold, Anthrazit,
Sand und Weiß. Die Farbpalette muss zugleich Text lesbar machen und
Bedienelemente sowie Fokuszustände erkennbar halten.

## Entscheidung

Primitive Abstufungen werden in `css/tokens/colors.css` gepflegt und über
semantische Tokens wie `--color-background`, `--color-surface`, `--color-text`,
`--color-border` und `--color-focus` verwendet. Aktuelle Kernwerte sind
Bordeaux `#641F32`, Elfenbein `#F5F0E6`, Sand `#E7DFD3`, Gold `#B08D57` und
Anthrazit `#292629`.

Gold `#B08D57` dient auf hellen Flächen nur dekorativen Zwecken. Für Text und
Fokus ist der dunklere Goldton `#80633D` vorgesehen. Statusfarben werden in
Textform oder mit einem weiteren eindeutigen Hinweis vermittelt, nie nur durch
Farbe.

Vor der Freigabe einer Farbkombination gelten mindestens:

- 4,5:1 für normalen Text
- 3:1 für großen Text sowie UI-Komponenten und grafische Informationen

Fokuszustände benötigen einen sichtbaren Kontrast zum Element und seinem
Hintergrund. Bei Bedarf sorgt ein kontrastierender Umriss oder Hintergrundring
für die Trennung.

## Folgen und offene Punkte

Die bisher rechnerisch geprüften Kombinationen umfassen unter anderem
Bordeaux/Elfenbein (10,36:1), Anthrazit/Elfenbein (13,17:1) und dunkles
Gold/Elfenbein (4,90:1). Das helle Gold auf Elfenbein erreicht nur 2,72:1 und
ist daher kein geeigneter Textfarbton. Statusfarben und neue Kombinationen sind
vor ihrer Verwendung separat zu prüfen.

Die Palette ist ein Ausgangspunkt und nicht als finale Markenfreigabe zu
verstehen. Bei Farbänderungen müssen betroffene Kontraste erneut berechnet und
dieser ADR sowie die README-Dokumentation aktualisiert werden.
