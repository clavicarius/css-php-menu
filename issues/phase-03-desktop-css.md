# Phase 3: Desktop-CSS für die Hauptnavigation

**Typ:** Umsetzungsphase
**Bezug:** Eltern-Issue #2; CSS-Architektur gemäß README und ADRs 0001, 0002 und 0004 beachten
**Abhängigkeiten:** Phase 1 – HTML-Prototyp; Phase 2 – Renderer

## Ziel

Die Hauptnavigation für breite Ansichten horizontal gestalten und Dropdowns sowie Flyouts ohne abgeschnittene Inhalte nutzbar machen. Dabei wird die vorhandene Navigationskomponente im zentralen CSS-Designsystem erweitert.

## Umfang

- `css/components/navigation.css` erweitern, statt ein paralleles Navigations-Stylesheet anzulegen.
- Komponenten-CSS über die bestehende Import-Reihenfolge in `css/main.css` laden lassen; `css/main.css` bleibt der zentrale Einstiegspunkt.
- Horizontale Ebene 1 mit separat bedienbaren Untermenü-Schaltern gestalten.
- Ebene 2 als Dropdown direkt unter dem zugehörigen Eintrag positionieren.
- Ebene 3 als Flyout seitlich positionieren und eine alternative Richtung bei Platzmangel ermöglichen.
- Öffnen über Hover und Tastaturfokus unterstützen; Hover darf nicht die einzige Bedienmöglichkeit sein.
- Fokus-, aktiven und geöffneten Zustand sichtbar darstellen.
- Vorhandene semantische Tokens für Farben, Abstände, Typografie und Effekte aus `css/tokens/` verwenden; keine konkurrierende Farbpalette oder ad-hoc Farbwerte in der Komponente anlegen.
- Falls ein benötigter Entwurfswert fehlt, zuerst prüfen, ob er als zentrales Token in der passenden Token-Datei sinnvoll ist; Farbwerte über Palette- und semantische Tokens einbinden.
- Hauptnavigation und Footer behalten getrennte Dateien unter `css/components/`; keine gemeinsame Komponenten-CSS-Datei anlegen.
- Responsive Breakpoints als Media Queries definieren, nicht als CSS Custom Properties.

## Akzeptanzkriterien

- Pro Ebene ist höchstens ein Untermenü geöffnet.
- Alle Inhalte bleiben bei langen Bezeichnungen und begrenztem Platz erreichbar.
- Bedienung per Tastatur und Zeigegerät funktioniert.
- Fokusindikatoren und Zustände sind ausreichend kontrastreich und nicht allein farblich erkennbar.
- Farben und wiederverwendbare Gestaltungswerte stammen aus dem zentralen Token-System; benötigte Änderungen an Palette oder CSS-Architektur aktualisieren auch die betroffenen ADRs und README-Vorgaben.
- Alle tatsächlich eingesetzten Text-, UI- und Fokusfarbkombinationen erfüllen die im Designsystem dokumentierten Kontrastanforderungen; Gold wird auf hellen Flächen nicht für Text verwendet.
- `prefers-reduced-motion` wird berücksichtigt; Animationen sind keine Voraussetzung für die Bedienung.

## Nicht-Ziele

- Mobile Panel oder JavaScript-Positionierungslogik, sofern CSS die Anforderungen erfüllt.
