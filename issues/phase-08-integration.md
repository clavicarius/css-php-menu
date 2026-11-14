# Phase 8: Einbindung in das Website-Layout

**Typ:** Umsetzungsphase
**Bezug:** Eltern-Issue #2
**Abhängigkeiten:** Phasen 1–7

## Ziel

Die fertig geprüfte Hauptnavigation und den Footer zentral in das gemeinsame Website-Layout integrieren und auf allen relevanten Seiten wiederverwenden.

## Repository-Kontext

Das Repository enthält aktuell das CSS-Designsystem, jedoch keine PHP-Anwendung, Seiten-Templates oder gemeinsamen Layoutdateien. Vor der Integration muss deshalb der konkrete Zielort der Website-Anwendung identifiziert und die Integration dort nachvollziehbar umgesetzt werden; es darf nicht von bereits vorhandenen Seiten oder Layoutdateien in diesem Repository ausgegangen werden.

## Umfang

- Komponenten an den vorgesehenen Stellen in Header und Seitenlayout einbinden.
- `css/main.css` als zentralen CSS-Einstiegspunkt einbinden; Navigations- und Footer-Stile bleiben in ihren getrennten, dort importierten Komponenten-Stylesheets.
- Das Hauptnavigations-JavaScript nur ergänzend und nur für die Hauptnavigation laden; es gehört nicht in `css/main.css`. Der Footer benötigt kein JavaScript.
- Menüdefinitionen ausschließlich an den jeweiligen zentralen Konfigurationsdateien pflegen.
- Bestehende Seitenstruktur und Inhalte bei der Einbindung erhalten.
- Seitenübergreifende Einbindung und aktuelle Seitenmarkierung kontrollieren.

## Akzeptanzkriterien

- Navigation und Footer werden auf allen relevanten Seiten eingebunden.
- Komponenten werden nicht seitenweise dupliziert.
- Hauptmenü und Footermenü bleiben vollständig unabhängig.
- Die Zielanwendung und ihr Layout sind ausdrücklich identifiziert; `css/main.css` wird zentral und nicht komponentenweise wiederholt eingebunden.
- CSS und JavaScript werden nur gemäß Komponentenbedarf eingebunden; Footer benötigt kein JavaScript.
- Die Abnahme aus Phase 7 bleibt nach der Integration erfolgreich.

## Definition of Done

- Alle in Eltern-Issue #2 definierten Abnahmekriterien sind erfüllt oder verbleibende Punkte sind transparent als Folgearbeit erfasst.
