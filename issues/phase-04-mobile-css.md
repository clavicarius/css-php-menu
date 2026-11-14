# Phase 4: Responsive Mobile-Navigation

**Typ:** Umsetzungsphase
**Bezug:** Eltern-Issue #2; CSS-Variablen gemäß Anforderung zu Issue #2 berücksichtigen
**Abhängigkeiten:** Phase 1 – HTML-Prototyp; Phase 2 – Renderer; Phase 3 – Desktop-CSS

## Ziel

Die Navigation bei beengtem Platz als zugängliches Panel unterhalb des sichtbaren Headers darstellen und den Wechsel zwischen Ansichten ohne Funktionsverlust ermöglichen.

## Umfang

- Den Umschaltpunkt nach verfügbarem Platz statt nach einer fest vorgegebenen Gerätekategorie wählen.
- Panel unterhalb des Headers über dem Seiteninhalt anzeigen und verfügbare Breite nutzen.
- Eigenständige Schließen-Schaltfläche und getrennte Untermenü-Schalter vorsehen.
- Untermenüs hierarchisch aufklappen und nur den aktuellen Navigationspfad anzeigen.
- CSS Custom Properties für mobile Komponentenwerte verwenden, ohne eine gemeinsame CSS-Datei mit dem Footer einzuführen.
- Verhalten bei Hoch-/Querformat, langen Bezeichnungen und 200 % Zoom prüfen.

## Akzeptanzkriterien

- Header bleibt sichtbar und Panelinhalte werden nicht abgeschnitten.
- Menü kann per Menüschalter, Schließen-Schaltfläche, Linkauswahl und Klick außerhalb geschlossen werden; Escape wird durch native oder progressive Ergänzung abgedeckt.
- Desktop-/Mobile-Wechsel lässt keine Links oder Untermenüs unzugänglich zurück.
- Fokus bleibt beim Öffnen, Schließen und Wechseln nachvollziehbar.
- Mobile Bedienziele erfüllen mindestens die WCAG-2.2-AA-Mindestgröße von 24 × 24 CSS-Pixeln, wo die Ausnahmebedingungen nicht greifen.
- Die CSS Custom Properties sind komponentenbezogen und verändern nicht die Daten- oder HTML-Struktur.

## Nicht-Ziele

- Footer-Akkordeon oder eigenständige JavaScript-Implementierung, sofern nativ möglich.
