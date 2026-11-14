# Phase 3: Desktop-CSS für die Hauptnavigation

**Typ:** Umsetzungsphase  
**Bezug:** Eltern-Issue #2; CSS-Variablen gemäß Anforderung zu Issue #2 berücksichtigen  
**Abhängigkeiten:** Phase 1 – HTML-Prototyp; Phase 2 – Renderer

## Ziel

Die Hauptnavigation für breite Ansichten horizontal gestalten und Dropdowns sowie Flyouts ohne abgeschnittene Inhalte nutzbar machen.

## Umfang

- Horizontale Ebene 1 mit separat bedienbaren Untermenü-Schaltern gestalten.
- Ebene 2 als Dropdown direkt unter dem zugehörigen Eintrag positionieren.
- Ebene 3 als Flyout seitlich positionieren und eine alternative Richtung bei Platzmangel ermöglichen.
- Öffnen über Hover und Tastaturfokus unterstützen; Hover darf nicht die einzige Bedienmöglichkeit sein.
- Fokus-, aktiven und geöffneten Zustand sichtbar darstellen.
- CSS Custom Properties für anpassbare visuelle Werte (z. B. Farben, Abstände, Fokusdarstellung und Schatten) verwenden.
- Keine gemeinsame Hauptnavigation-/Footer-CSS-Datei einführen; Variablen in der passenden Komponenten-CSS-Datei definieren.

## Akzeptanzkriterien

- Pro Ebene ist höchstens ein Untermenü geöffnet.
- Alle Inhalte bleiben bei langen Bezeichnungen und begrenztem Platz erreichbar.
- Bedienung per Tastatur und Zeigegerät funktioniert.
- Fokusindikatoren und Zustände sind ausreichend kontrastreich und nicht allein farblich erkennbar.
- Visuelle Werte sind über CSS Custom Properties wartbar; Breakpoints werden nicht über nicht unterstützte Media-Query-Variablen umgesetzt.
- `prefers-reduced-motion` wird berücksichtigt; Animationen sind keine Voraussetzung für die Bedienung.

## Nicht-Ziele

- Mobile Panel oder JavaScript-Positionierungslogik, sofern CSS die Anforderungen erfüllt.
