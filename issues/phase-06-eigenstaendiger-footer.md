# Phase 6: Eigenständiger Footer

**Typ:** Umsetzungsphase  
**Bezug:** Eltern-Issue #2; CSS-Variablen gemäß Anforderung zu Issue #2 berücksichtigen  
**Abhängigkeiten:** Phase 1 – semantische Struktur; Phase 2 – Validierungs-/Renderer-Entscheidungen

## Ziel

Eine separat gepflegte Footer-Komponente mit eigener Datenquelle, eigenem Template und eigenem Stylesheet erstellen.

## Umfang

- `config/footer-menu.php` unabhängig von `config/main-menu.php` pflegen.
- `includes/footer.php` und `assets/css/footer.css` als eigenständige Komponente umsetzen.
- Footer-Navigation mit eigener `nav`-Beschriftung ausgeben.
- Desktop-Links nebeneinander mit Zeilenumbruch darstellen; auf kleinen Ansichten Inhalte untereinander und Links nebeneinander umbrechen lassen.
- Copyright in einer separaten Zeile ausgeben.
- Externe Links nach denselben Sicherheits- und Screenreader-Regeln wie in der Hauptnavigation behandeln.
- CSS Custom Properties für Footer-eigene visuelle Werte verwenden; keine gemeinsame Footer-/Navigations-CSS-Datei oder gemeinsame Menüdefinition schaffen.

## Akzeptanzkriterien

- Footer wird ausschließlich aus seiner eigenen Menüdefinition generiert.
- Es gibt keine automatische Übernahme von Hauptmenüeinträgen.
- Layout funktioniert responsiv mit Zeilenumbruch und ohne horizontales Abschneiden.
- Footer ist vollständig ohne JavaScript bedienbar.
- Footer-Struktur, Daten und Gestaltung bleiben getrennt von der Hauptnavigation.
