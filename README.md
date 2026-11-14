# CSS-Designsystem

Zentrale CSS-Tokens und Basiskomponenten für die Website der Kammeroper Augsburg.
`css/main.css` ist der Einstiegspunkt und importiert Tokens, Basisstile und Komponenten.

## Verwendung

```html
<link rel="stylesheet" href="css/main.css">
```

## Beispielseite

Die [Beispielseite](https://clavicarius.github.io/css-php-menu/) zeigt eine Lorem-ipsum-Website mit Haupt- und
Servicenavigation. Sie kann lokal über einen beliebigen statischen Webserver
aufgerufen werden. Bei jedem Push auf `main` veröffentlicht der Workflow
`.github/workflows/pages.yml` die Seite auf GitHub Pages; alternativ lässt sich
die Veröffentlichung manuell über `workflow_dispatch` starten.

Komponenten verwenden ausschließlich semantische Variablen aus
`css/tokens/colors.css`. Neue Farbwerte gehören in die Palette und werden über
semantische Tokens eingebunden. Gold (`--color-accent`) ist dekorativ; für Text
und Fokusindikatoren wird der kontrastgeprüfte dunklere Goldton
(`--color-accent-strong`) verwendet.

Die Farbwerte sind ein erster, rechnerisch geprüfter Entwurf. Bordeaux
(`#641F32`) auf Elfenbein (`#F5F0E6`) erreicht 10,36:1, Anthrazit
(`#292629`) auf Elfenbein 13,17:1 und der dunkle Goldton (`#80633D`) auf
Elfenbein 4,90:1. Das hellere Gold (`#B08D57`) erreicht dort nur 2,72:1 und
wird deshalb nicht für Text verwendet. Vor dem produktiven Einsatz sind alle
tatsächlich verwendeten Kombinationen erneut zu prüfen.

## Schriftdateien

Die Schriftdeklarationen erwarten lokal bereitgestellte WOFF2-Dateien unter
`assets/fonts/`:

- `cormorant-garamond-variable.woff2`
- `source-sans-3-variable.woff2`

Die Dateien sind in diesem Repository nicht vorhanden; bis sie ergänzt werden,
greifen die definierten System-Fallbacks. Es gibt keine externe Font-Abhängigkeit.

## Architekturentscheidungen

Die Gründe und Folgen der Designsystem-Entscheidungen sind in den
[Architecture Decision Records](docs/adr/README.md) dokumentiert.

## Navigationsprototyp

Der semantische [HTML-Prototyp der Hauptnavigation](prototypes/navigation.html)
und seine [Interaktions- und Prüfhinweise](docs/navigation-prototype.md) zeigen
die native Bedienung verschachtelter Untermenüs ohne JavaScript.

## Vorgaben für Änderungen

- `css/main.css` bleibt der zentrale Einstiegspunkt; neue Stylesheets werden dort
  in der Reihenfolge Tokens, Basisstile, Komponenten eingebunden.
- Komponenten verwenden semantische Tokens statt eigener Farbwerte. Neue
  Farbwerte werden zuerst als Palette-Tokens angelegt und anschließend semantisch
  zugeordnet.
- Vor der Verwendung einer Text-, UI- oder Fokusfarbkombination ist ihr Kontrast
  zu prüfen: mindestens 4,5:1 für normalen Text und 3:1 für großen Text,
  Bedienelemente und grafische Informationen.
- Gold ist auf hellen Flächen kein Textfarbton. Status und Bedeutung dürfen nie
  allein durch Farbe vermittelt werden.
- Fokus muss sichtbar bleiben; Animationen berücksichtigen
  `prefers-reduced-motion`. Layouts und Schriftgrößen müssen auf schmalen
  Viewports funktionieren.
- Schriften werden nur lokal und in benötigten Schnitten/Formaten eingebunden.
  Vor dem Einchecken sind Lizenz und tatsächliches Vorhandensein der Fontdateien
  zu prüfen.

Die dokumentierten Farbwerte sind ein geprüfter Ausgangspunkt, aber noch nicht
als finale Markenpalette freigegeben. Bei Änderungen an Palette, Typografie oder
CSS-Architektur ist der passende ADR zu aktualisieren oder ein neuer ADR
hinzuzufügen.
