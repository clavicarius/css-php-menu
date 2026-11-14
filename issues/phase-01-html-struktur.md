# Phase 1 (#7): Semantischer HTML-Prototyp der Hauptnavigation

**Typ:** Umsetzungsphase
**Bezug:** Eltern-Issue #2
**Abhängigkeiten:** Keine

## Ziel

Einen semantischen, zunächst ungestalteten HTML-Prototyp für die Hauptnavigation erstellen und die native Bedienbarkeit der Untermenüs validieren, bevor PHP-Logik oder visuelle Gestaltung ergänzt wird.

## Repository-Kontext

Das Repository enthält inzwischen ein zentrales CSS-Designsystem unter `css/`, aber noch keine PHP-Menükomponenten oder Website-Seiten. Der Prototyp soll deshalb die HTML- und Interaktionsgrundlage definieren, ohne bestehende globale oder komponentenbezogene CSS-Regeln zu duplizieren.

## Umfang

- Hauptnavigation mit Links und bis zu drei hierarchischen Ebenen abbilden.
- Für Einträge mit Unterpunkten Navigation und Untermenü-Schalter als getrennte Bedienelemente vorsehen.
- `details`/`summary` als native Lösung prüfen; Grenzen bei Exklusivität, Hover, Fokus und verschachtelten Untermenüs dokumentieren.
- Normale Tab-Reihenfolge und sichtbaren Tastaturfokus sicherstellen.
- Bedienbarkeit ohne JavaScript prüfen.
- Die bestehende Navigations-CSS in `css/components/navigation.css` als Designsystem-Baseline berücksichtigen; die fertige visuelle Ausgestaltung bleibt Phase 3 (#9) und 4 (#10) vorbehalten.

## Akzeptanzkriterien

- Markup verwendet geeignete native HTML-Elemente und eine beschriftete `nav`-Landmarke.
- Jeder Menüpunkt bleibt ein normaler Link, auch wenn er Unterpunkte besitzt.
- Die drei Ebenen sind ohne JavaScript per Tastatur erreichbar.
- Die Grundstruktur funktioniert mit Screenreadern und benötigt keine unnötigen ARIA-Menürollen.
- Offene technische Fragen zu nativer Interaktion und Fokus sind festgehalten.

## Nicht-Ziele

- PHP-Renderer, Produktionsdaten und visuelle Gestaltung.
- JavaScript-Komfortfunktionen.
