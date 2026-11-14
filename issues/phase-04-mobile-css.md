# Phase 4 (#10): Responsive Mobile-Navigation

**Typ:** Umsetzungsphase
**Bezug:** Eltern-Issue #2; CSS-Architektur gemäß README und ADRs 0001, 0002 und 0004 beachten
**Abhängigkeiten:** Phase 1 (#7) – HTML-Prototyp; Phase 2 (#8) – Renderer; Phase 3 (#9) – Desktop-CSS

## Ziel

Die Navigation bei beengtem Platz als zugängliches Panel unterhalb des sichtbaren Headers darstellen und den Wechsel zwischen Ansichten ohne Funktionsverlust ermöglichen. Die responsiven Regeln werden in der bereits vorhandenen Navigationskomponente gepflegt.

## Umfang

- `css/components/navigation.css` um die mobilen Regeln ergänzen und das Stylesheet weiterhin über `css/main.css` laden.
- Den Umschaltpunkt nach verfügbarem Platz statt nach einer fest vorgegebenen Gerätekategorie wählen.
- Panel unterhalb des Headers über dem Seiteninhalt anzeigen und verfügbare Breite nutzen.
- Eigenständige Schließen-Schaltfläche und getrennte Untermenü-Schalter vorsehen.
- Untermenüs hierarchisch aufklappen und nur den aktuellen Navigationspfad anzeigen.
- Vorhandene semantische Tokens aus `css/tokens/` für Farben, Abstände, Typografie und Effekte verwenden; keine zweite Token-Sammlung oder konkurrierenden Farbwerte in der Komponente anlegen.
- Hauptnavigation und Footer behalten getrennte Komponenten-Stylesheets; kein gemeinsames Footer-/Navigations-Stylesheet einführen.
- Verhalten bei Hoch-/Querformat, langen Bezeichnungen und 200 % Zoom prüfen.

## Akzeptanzkriterien

- Header bleibt sichtbar und Panelinhalte werden nicht abgeschnitten.
- Menü kann per Menüschalter, Schließen-Schaltfläche, Linkauswahl und Klick außerhalb geschlossen werden; Escape wird durch native oder progressive Ergänzung abgedeckt.
- Desktop-/Mobile-Wechsel lässt keine Links oder Untermenüs unzugänglich zurück.
- Fokus bleibt beim Öffnen, Schließen und Wechseln nachvollziehbar.
- Mobile Bedienziele erfüllen mindestens die WCAG-2.2-AA-Mindestgröße von 24 × 24 CSS-Pixeln, wo die Ausnahmebedingungen nicht greifen.
- Farben und wiederverwendbare Gestaltungswerte stammen aus den zentralen Tokens; alle verwendeten Text-, UI- und Fokusfarbkombinationen erfüllen die im Designsystem dokumentierten Kontrastanforderungen.
- Responsive Breakpoints sind Media Queries und keine CSS Custom Properties.

## Nicht-Ziele

- Footer-Akkordeon oder eigenständige JavaScript-Implementierung, sofern nativ möglich.
