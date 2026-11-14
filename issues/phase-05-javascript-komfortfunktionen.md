# Phase 5: Progressive JavaScript-Komfortfunktionen

**Typ:** Umsetzungsphase  
**Bezug:** Eltern-Issue #2  
**Abhängigkeiten:** Phasen 1–4

## Ziel

Nur Interaktionen ergänzen, die mit nativen HTML- und CSS-Mitteln nicht zuverlässig erfüllt werden, ohne JavaScript zur Voraussetzung für die Navigation zu machen.

## Umfang

- Klick außerhalb des mobilen Panels schließt dieses.
- Escape schließt das Panel bzw. das relevante Untermenü.
- Linkauswahl schließt das mobile Panel.
- Fokus beim Schließen sinnvoll wiederherstellen und bei Ansichtswechseln Zustände bereinigen.
- Flyout-Positionierung nur ergänzen, falls CSS die Anforderungen nicht erfüllt.
- JavaScript ausschließlich für die Hauptnavigation laden und ohne externe Bibliotheken auskommen.

## Akzeptanzkriterien

- Hauptnavigation und alle Links bleiben ohne JavaScript vollständig nutzbar.
- JavaScript-Zustände stimmen mit dem tatsächlichen nativen Öffnungszustand und erforderlichen ARIA-Zuständen überein.
- Escape, Außenklick und Linkauswahl verursachen weder Fokusverlust noch Tastaturfallen.
- Fehler oder fehlendes JavaScript verhindern nicht den Zugriff auf Navigationsebenen.
- Kein Verhalten wird doppelt implementiert, wenn es zuverlässig nativ möglich ist.
