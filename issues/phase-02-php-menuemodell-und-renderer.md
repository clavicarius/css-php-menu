# Phase 2: PHP-Menümodell und Renderer

**Typ:** Umsetzungsphase  
**Bezug:** Eltern-Issue #2  
**Abhängigkeiten:** Phase 1 – semantische HTML-Struktur

## Ziel

Hauptmenü zentral in PHP definieren, validieren und anhand eines wiederverwendbaren Renderers als die in Phase 1 festgelegte HTML-Struktur ausgeben.

## Umfang

- `config/main-menu.php` als unabhängige Datenquelle für das Hauptmenü anlegen.
- `title`, `url`, `external` und optionale `children` validieren.
- Fehlende Pflichtwerte, ungültige Datentypen und mehr als drei Ebenen zuverlässig zurückweisen.
- URLs normalisieren und die aktuelle Seite ohne Teilstring-Fehlzuordnungen erkennen.
- Externe Links ausschließlich anhand von `external` behandeln; `target="_blank"`, `rel="noopener noreferrer"`, Symbol und Screenreader-Hinweis ausgeben.
- HTML-Attribute und Text kontextgerecht maskieren.
- Aktuelle Seite mit `aria-current="page"` und Vorfahren mit einem dezenten Zustand kennzeichnen.

## Akzeptanzkriterien

- Die Menüdefinition enthält keine Darstellungs- oder CSS-Informationen.
- Ungültige Menüdaten werden erkennbar abgewiesen.
- Abschließende Slashes, Query-Parameter und URL-kodierte Zeichen führen zu korrekter Zuordnung.
- `/oper` wird nicht mit `/operette` verwechselt.
- Der Renderer erzeugt die in Phase 1 vereinbarte semantische Struktur und benötigt für grundlegende Navigation kein JavaScript.
- Externe Links und benutzergesteuerte Texte werden sicher ausgegeben.

## Nicht-Ziele

- Footer-Daten oder gemeinsame Hauptmenü-/Footer-Datenquelle.
- Visuelle Gestaltung oder responsive Interaktionslogik.
