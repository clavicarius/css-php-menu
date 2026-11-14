# Phase 7 (#13): Responsive-, Funktions- und Barrierefreiheitsprüfung

**Typ:** Umsetzungsphase
**Bezug:** Eltern-Issue #2
**Abhängigkeiten:** Phasen 1–6

## Ziel

Hauptnavigation und Footer systematisch gegen die funktionalen, responsiven, technischen und WCAG-2.2-AA-Anforderungen prüfen.

## Umfang

- Menüziele, drei Ebenen, aktive Seite, Vorfahren und externe Links prüfen.
- Tastaturbedienung einschließlich Tab, Shift+Tab, Enter, Leertaste und Escape prüfen.
- Screenreader, Fokusführung, ARIA-Zustände und Landmarken manuell überprüfen.
- Smartphone (Hoch-/Querformat), Tablet, verschiedene Desktopbreiten, lange Menüs und 200 % Zoom testen.
- Funktion mit und ohne JavaScript sowie HTML-/PHP-Fehler prüfen.
- Prüfen, dass `css/main.css` zentral eingebunden bleibt und Hauptnavigation/Footer getrennte Komponenten-Stylesheets unter `css/components/` verwenden.
- Token-Nutzung gegen README und ADRs prüfen: Komponenten nutzen semantische Tokens aus `css/tokens/`; keine verstreuten Farbwerte oder konkurrierenden Paletten.
- Kontrast jeder tatsächlich eingesetzten Text-, UI- und Fokusfarbkombination nach den dokumentierten Schwellen prüfen; die Palette ist vorläufig und muss vor produktivem Einsatz erneut geprüft werden.
- Touch-Zielgrößen, sichtbaren Fokus, `prefers-reduced-motion` und responsive Typografie inklusive Font-Fallbacks prüfen.
- Automatisierte Werkzeuge wie axe oder WAVE unterstützend einsetzen; manuelle Prüfung nicht ersetzen.

## Akzeptanzkriterien

- Alle Prüfpunkte und Ergebnisse sind nachvollziehbar dokumentiert.
- Es bestehen keine wesentlichen Funktions-, Responsive- oder Barrierefreiheitsfehler.
- Keine Tastaturfallen, abgeschnittenen Inhalte oder inkonsistenten ARIA-/Öffnungszustände.
- Hauptnavigation und Footer verwenden weiterhin getrennte Datenquellen, Templates und Stylesheets.
- Neue oder geänderte Designsystem-Entscheidungen sind mit README und den betroffenen ADRs konsistent.
- Festgestellte Fehler werden vor Integration behoben oder mit konkretem Folgeissue festgehalten.
