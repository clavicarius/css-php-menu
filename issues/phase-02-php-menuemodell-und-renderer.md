# Phase 2 (#8): PHP-Menümodell und Renderer

**Typ:** Umsetzungsphase
**Bezug:** Eltern-Issue #2
**Abhängigkeiten:** Phase 1 (#7) – semantische HTML-Struktur

## Ziel

Hauptmenü zentral in PHP definieren, validieren und anhand eines wiederverwendbaren Renderers als die in Phase 1 (#7) festgelegte HTML-Struktur ausgeben.

## Repository-Kontext

Das bestehende Repository stellt ein CSS-Designsystem bereit, enthält aber noch keine PHP-Anwendung, Menü-Konfigurationen oder Website-Seiten. Diese Phase ergänzt die im Eltern-Issue vorgesehenen PHP-Dateien; sie soll keine CSS- oder Design-Token-Definitionen in das Menümodell aufnehmen.

## Umfang

- `config/main-menu.php` als unabhängige Datenquelle für das Hauptmenü anlegen.
- `title`, `url`, `external` und optionale `children` validieren.
- Fehlende Pflichtwerte, ungültige Datentypen und mehr als drei Ebenen zuverlässig zurückweisen.
- URLs normalisieren und die aktuelle Seite ohne Teilstring-Fehlzuordnungen erkennen.
- Externe Links ausschließlich anhand von `external` behandeln; `target="_blank"`, `rel="noopener noreferrer"`, Symbol und Screenreader-Hinweis ausgeben.
- HTML-Attribute und Text kontextgerecht maskieren.
- Aktuelle Seite mit `aria-current="page"` und Vorfahren mit einem dezenten Zustand kennzeichnen.
- Die Daten- und Renderer-Struktur so halten, dass der Footer später einen getrennten Menüdatenbestand nutzen kann, ohne eine gemeinsame inhaltliche Datenquelle zu schaffen.

## Akzeptanzkriterien

- Die Menüdefinition enthält keine Darstellungs- oder CSS-Informationen.
- Ungültige Menüdaten werden erkennbar abgewiesen.
- Abschließende Slashes, Query-Parameter und URL-kodierte Zeichen führen zu korrekter Zuordnung.
- `/oper` wird nicht mit `/operette` verwechselt.
- Der Renderer erzeugt die in Phase 1 (#7) vereinbarte semantische Struktur und benötigt für grundlegende Navigation kein JavaScript.
- Externe Links und benutzergesteuerte Texte werden sicher ausgegeben.
- Die Menüdefinition enthält ausschließlich Inhaltsdaten; visuelle Zustände werden über Markup und die Komponentenstile ausgedrückt.

## Nicht-Ziele

- Footer-Daten oder gemeinsame Hauptmenü-/Footer-Datenquelle.
- Visuelle Gestaltung oder responsive Interaktionslogik.
