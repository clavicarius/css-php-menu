# CSS-Designsystem

Zentrale CSS-Tokens und Basiskomponenten für die Website der Kammeroper Augsburg.
`css/main.css` ist der Einstiegspunkt und importiert Tokens, Basisstile und Komponenten.

## Verwendung

```html
<link rel="stylesheet" href="css/main.css">
```

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
