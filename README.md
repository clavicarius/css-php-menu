# CSS-Designsystem

Zentrale CSS-Tokens und Basiskomponenten für die Website der Kammeroper Augsburg.
`css/main.css` ist der Einstiegspunkt und importiert Tokens, Basisstile und Komponenten.

## Verwendung

Für die vollständige Beispielseite mit globalen Stilen und Schriften:

```html
<link rel="stylesheet" href="css/main.css">
```

### Menü in ein anderes Projekt einbinden

#### 1. Dateien kopieren

Voraussetzung ist PHP 8.1 oder neuer. Kopiere die Dateien in das Zielprojekt und
behalte ihre relativen Pfade bei:

```text
projekt/
├── css/
│   ├── menu.css
│   └── components/
│       ├── navigation.css
│       └── footer.css
├── js/
│   └── navigation.js
├── src/
│   ├── MenuRenderer.php
│   └── MenuItems.php
└── includes/
    └── footer.php        (nur für den Footer)
```

`css/menu.css` bindet keine globalen Seitenstile oder Schriftdateien ein. Die
Komponenten übernehmen die Schrift des Projekts und haben eigene Standardwerte.

#### 2. CSS und JavaScript einbinden

Im `<head>` der Seite:

```html
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/menu.css">
<script src="/js/navigation.js" defer></script>
```

Die URLs an den öffentlichen Pfad des Zielprojekts anpassen. Das Skript wird
für die mobile Navigation und die Umschaltung zwischen Ansichten benötigt.

#### 3. Menü konfigurieren und ausgeben

Das folgende Beispiel gehört in eine PHP-Seite im Projektverzeichnis, an die
Stelle der gewünschten Navigation:

```php
<?php
require_once __DIR__ . '/src/MenuRenderer.php';

$items = [
    ['title' => 'Start', 'url' => '/', 'external' => false],
    [
        'title' => 'Programm',
        'url' => '/programm',
        'external' => false,
        'children' => [
            ['title' => 'Spielplan', 'url' => '/programm/spielplan', 'external' => false],
        ],
    ],
];

echo (new MenuRenderer($items))->render($_SERVER['REQUEST_URI'] ?? '/');
```

Jeder Eintrag benötigt `title`, `url` und das boolesche `external`. `children`
ist optional; maximal drei Ebenen sind erlaubt. Einträge mit Kindern sind
Schalter, ihre URLs dienen der Zuordnung zur aktuellen Seite; nur Einträge ohne
Kinder sind Links. URLs müssen mit `/` beginnen oder absolute HTTP(S)-URLs sein.
`external: true` öffnet den Link in einem neuen Tab. Ungültige Daten lösen eine
`InvalidArgumentException` aus.

#### 4. Footer einbinden (optional)

An der gewünschten Stelle in derselben PHP-Seite eigene Daten übergeben:

```php
<?php
$footerItems = [
    ['title' => 'Kontakt', 'url' => '/kontakt', 'external' => false],
];
$footerCopyright = 'Mein Projekt';
require __DIR__ . '/includes/footer.php';
```

Ohne eigene Footer-Daten wird `config/footer-menu.php` verwendet; diese Datei
muss dann ebenfalls kopiert werden. Ohne eigenen Copyright-Text erscheint der
Name der Beispielseite.

#### 5. Gestaltung anpassen und prüfen

Die semantischen CSS-Variablen können im Zielprojekt überschrieben werden,
beispielsweise nach dem Einbinden von `menu.css`:

```css
.site-nav,
.site-footer {
  --color-primary: #183b5b;
  --color-primary-hover: #102a42;
  --color-text-inverse: #fff;
}
```

Weitere Variablen und ihre Standardwerte stehen in den beiden
Komponenten-Stylesheets. Neue Farbkombinationen auf Kontrast prüfen.
Die PHP-Seite über einen PHP-fähigen Webserver aufrufen und Desktop, Mobilansicht,
Tastaturbedienung und Links testen. Die Hauptnavigation ist derzeit einmal pro
Seite vorgesehen, da sie eine feste Panel-ID verwendet.

#### PHP-Demo starten

[`php-demo.php`](php-demo.php) zeigt die Einbindung mit drei Menüebenen und
einem Footer. Sie kann zusammen mit den oben aufgeführten Dateien ins
Zielprojekt kopiert werden; die Beispiel-URLs müssen dort angepasst werden.
Zum lokalen Test im Projektverzeichnis ausführen:

```shell
php -S localhost:8000
```

Anschließend `http://localhost:8000/php-demo.php` im Browser öffnen.

## Beispielseite

Die [Beispielseite](https://clavicarius.github.io/css-php-menu/) zeigt eine Lorem-ipsum-Website mit Haupt- und
Servicenavigation. Sie kann lokal über einen beliebigen statischen Webserver
aufgerufen werden. Bei jedem Push auf `main` veröffentlicht der Workflow
`.github/workflows/pages.yml` die Seite auf GitHub Pages; alternativ lässt sich
die Veröffentlichung manuell über `workflow_dispatch` starten.

Komponenten verwenden semantische Variablen aus `css/tokens/colors.css` und
Fallbackwerte für die unabhängige Einbindung. Neue Farben des Designsystems
gehören in die Palette und werden über semantische Tokens eingebunden.
Gold (`--color-accent`) ist dekorativ; für Text
und Fokusindikatoren wird der kontrastgeprüfte dunklere Goldton
(`--color-accent-strong`) verwendet.

Die Farbwerte sind ein erster, rechnerisch geprüfter Entwurf. Bordeaux
(`#641F32`) auf Elfenbein (`#F5F0E6`) erreicht 10,36:1, Anthrazit
(`#292629`) auf Elfenbein 13,17:1 und der dunkle Goldton (`#80633D`) auf
Elfenbein 4,90:1. Das hellere Gold (`#B08D57`) erreicht dort nur 2,72:1 und
wird deshalb nicht für Text verwendet. Vor dem produktiven Einsatz sind alle
tatsächlich verwendeten Kombinationen erneut zu prüfen.

## Schriftdateien

Die Schriftdateien liegen lokal im WOFF2-Format unter `assets/fonts/`:

- `cormorant-garamond-variable.woff2`
- `cormorant-garamond-italic-variable.woff2`
- `source-sans-3-variable.woff2`
- `source-sans-3-italic-variable.woff2`

Es gibt keine externe Font-Abhängigkeit.

## Architekturentscheidungen

Die Gründe und Folgen der Designsystem-Entscheidungen sind in den
[Architecture Decision Records](docs/adr/README.md) dokumentiert.

## Navigationsprototyp

Der semantische [HTML-Prototyp der Hauptnavigation](prototypes/navigation.html)
und seine [Interaktions- und Prüfhinweise](docs/navigation-prototype.md) zeigen
die native Bedienung verschachtelter Untermenüs und die responsive Einbindung.

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

Die PHP-Prüfungen lassen sich mit `php test/menu.php` ausführen.
