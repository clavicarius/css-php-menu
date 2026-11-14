# Navigationsprototyp

Der HTML-Prototyp liegt unter [`prototypes/navigation.html`](../prototypes/navigation.html).
Er verwendet die vorhandenen Navigationsklassen und `css/main.css` als Designsystem-
Baseline; er ergänzt keine eigenen Stilregeln. Es gibt keine Skripte oder
JavaScript-Abhängigkeiten.

## Native Interaktion und Fokus

- Jeder Eintrag ist ein normaler Link. Bei Einträgen mit Kindern ist das
  jeweilige `details`/`summary` ein unabhängiger Schalter daneben.
- `summary` ist nativ per Tastatur bedienbar. Mit Enter oder Leertaste wird das
  zugehörige Untermenü geöffnet oder geschlossen; seine Links folgen danach in
  der normalen Tab-Reihenfolge. Verschachtelte Ebenen werden durch Öffnen des
  jeweiligen übergeordneten Untermenüs erreicht.
- Geschlossene `details`-Inhalte sind nicht in der Tab-Reihenfolge. Beim Öffnen
  wird der Fokus nicht automatisch in das Untermenü verschoben.
- Der Fokus bleibt über die bestehende `:focus-visible`-Regel in
  `css/base/global.css` sichtbar. Die Seite verwendet weder eigene Fokusregeln
  noch `menu`-/`menuitem`-Rollen.

## Grenzen und offene Prüfpunkte

- Einzelne `details`-Elemente sind standardmäßig nicht exklusiv. Das `name`-
  Attribut kann Elemente gruppieren, ist hier aber bewusst nicht eingesetzt;
  Browserunterstützung und gewünschtes Verhalten müssten vor einer Nutzung
  geprüft werden.
- `details` öffnet sich nicht durch Hover. Ein Hover-Verhalten wäre eine
  zusätzliche Gestaltung und darf die Tastaturbedienung nicht voraussetzen.
- Verhalten und Ansagen von `details`/`summary` sollten vor produktivem Einsatz
  mit den unterstützten Browsern und Screenreadern getestet werden.

## Manuelle Prüfung

`prototypes/navigation.html` direkt im Browser öffnen und JavaScript deaktivieren.
Mit Tab und Shift+Tab die Links und Schalter in Reihenfolge erreichen, mit Enter
oder Leertaste die Untermenüs auf- und zuklappen und bis zur dritten Ebene
navigieren. Dabei prüfen, dass der Fokus sichtbar bleibt und die Links auch
unabhängig von den Schaltern aktiviert werden können.
