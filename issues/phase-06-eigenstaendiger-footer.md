# Phase 6 (#12): Eigenständiger Footer

**Typ:** Umsetzungsphase
**Bezug:** Eltern-Issue #2; CSS-Architektur gemäß README und ADRs 0001, 0002 und 0004 beachten
**Abhängigkeiten:** Phase 1 (#7) – semantische Struktur; Phase 2 (#8) – Validierungs-/Renderer-Entscheidungen

## Ziel

Eine separat gepflegte Footer-Komponente mit eigener Datenquelle und eigenem Template erstellen und in das vorhandene zentrale CSS-Designsystem integrieren.

## Umfang

- `config/footer-menu.php` unabhängig von `config/main-menu.php` pflegen.
- `includes/footer.php` als eigenständige Komponente umsetzen.
- Das vorhandene `css/components/footer.css` erweitern und über `css/main.css` einbinden; keine parallele CSS-Datei unter `assets/css/` anlegen.
- Footer-Navigation mit eigener `nav`-Beschriftung ausgeben.
- Desktop-Links nebeneinander mit Zeilenumbruch darstellen; auf kleinen Ansichten Inhalte untereinander und Links nebeneinander umbrechen lassen.
- Copyright in einer separaten Zeile ausgeben.
- Externe Links nach denselben Sicherheits- und Screenreader-Regeln wie in der Hauptnavigation behandeln.
- Vorhandene semantische Tokens für Farben, Abstände, Typografie und Effekte verwenden; keine eigene Farbpalette oder unnötige komponentenspezifische Duplikate anlegen.
- Footer- und Navigationsstile sowie ihre Menüdefinitionen bleiben unabhängig voneinander.

## Akzeptanzkriterien

- Footer wird ausschließlich aus seiner eigenen Menüdefinition generiert.
- Es gibt keine automatische Übernahme von Hauptmenüeinträgen.
- Layout funktioniert responsiv mit Zeilenumbruch und ohne horizontales Abschneiden.
- Footer ist vollständig ohne JavaScript bedienbar.
- Footer-Struktur, Daten und Gestaltung bleiben getrennt von der Hauptnavigation.
- Änderungen an zentraler Palette oder CSS-Architektur werden entsprechend den Repository-Vorgaben auch in README und betroffenen ADRs dokumentiert.
