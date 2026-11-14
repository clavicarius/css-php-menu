# Navigationsprototyp

Der HTML-Prototyp liegt unter [`prototypes/navigation.html`](../prototypes/navigation.html).
Er verwendet die vorhandenen Navigationsklassen und `css/main.css` als Designsystem-
Baseline. Das optionale Skript erweitert die nativen Popover-Aktionen ohne externe
JavaScript-Abhängigkeiten.

## Native Interaktion und Fokus

- Jeder Eintrag ist ein normaler Link. Bei Einträgen mit Kindern ist das
  jeweilige `details`/`summary` ein unabhängiger Schalter daneben.
- In schmalen Ansichten öffnet der Menüschalter ein natives
  `popover="auto"`-Panel. Die Schließen-Schaltfläche, Escape und ein Klick
  außerhalb schließen es nativ. Escape schließt mit geladenem
  `js/navigation.js` zuerst das fokussierte offene Untermenü; ohne offenes
  Untermenü schließt es das Panel nativ. Das Skript schließt das Panel außerdem
  bei Linkauswahl und beim Wechsel zur Desktopbreite. Ein Layout mit
  PHP-gerenderter Navigation bindet dieses Skript mit `defer` ein, um dieselben
  Ergänzungen zu erhalten.
- Fehlt die Popover-Unterstützung, bleiben die Links ohne
  Umschalter sichtbar. Untermenüs verwenden exklusive `details`-Gruppen je Ebene,
  damit jeweils nur ein Navigationspfad geöffnet ist.
- `summary` ist nativ per Tastatur bedienbar. Mit Enter oder Leertaste wird das
  zugehörige Untermenü geöffnet oder geschlossen; seine Links folgen danach in
  der normalen Tab-Reihenfolge. Verschachtelte Ebenen werden durch Öffnen des
  jeweiligen übergeordneten Untermenüs erreicht.
- Geschlossene `details`-Inhalte sind nicht in der Tab-Reihenfolge. Beim Öffnen
  wird der Fokus nicht automatisch in das Untermenü verschoben.
- Der Fokus bleibt über die globale `:focus-visible`-Regel und die kontrastierten
  Fokusregeln der Navigationskomponente sichtbar. Die Seite verwendet keine
  `menu`-/`menuitem`-Rollen.

## Grenzen und offene Prüfpunkte

- Untermenüs verwenden das `name`-Attribut für exklusive Gruppen je Ebene.
  Browserunterstützung und Verhalten sollten mit den unterstützten Browsern
  geprüft werden.
- Desktop-Untermenüs werden zusätzlich bei Hover und Fokus sichtbar; diese
  Zustände ersetzen nicht die native Tastaturbedienung über `summary`.
- Verhalten und Ansagen von `details`/`summary` sollten vor produktivem Einsatz
  mit den unterstützten Browsern und Screenreadern getestet werden.

## Manuelle Prüfung

`prototypes/navigation.html` direkt im Browser öffnen und JavaScript deaktivieren.
Mit Tab und Shift+Tab die Links und Schalter in Reihenfolge erreichen, mit Enter
oder Leertaste die Untermenüs auf- und zuklappen und bis zur dritten Ebene
navigieren. Dabei prüfen, dass der Fokus sichtbar bleibt und die Links auch
unabhängig von den Schaltern aktiviert werden können.
Mit aktiviertem JavaScript in schmaler Ansicht zusätzlich das geöffnete Menü
und die Linkauswahl prüfen:
Das Panel überlagert den Inhalt und schließt bei der Auswahl eines Links.
Position und Scrollbarkeit auch nach Scrollen und Größenänderung prüfen.
