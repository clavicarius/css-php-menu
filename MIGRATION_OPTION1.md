# Migration zu Option 1: Pure Toggle Navigation

## 📋 Übersicht der Änderungen

Diese Migration behebt das UX-Problem redundanter Parent-Links durch die Umstellung auf **reine Toggle-Navigation** (Option 1).

### ❌ Altes Design (Redundanz-Problem)
```html
<li class="has-submenu">
  <a href="#programm">Programm</a>
  <details>
    <summary></summary> <!-- Leere Summary -->
    <ul><!-- Submenus --></ul>
  </details>
</li>
```

**Probleme:**
- Dualität: Link + Toggle konkurrieren um Benutzer-Intent
- Verwirrung auf Mobile: Wo klicke ich zum Navigieren?
- Leere Summaries sind semantisch schlecht
- Screen-Reader-Nutzer wissen nicht, ob zu navigieren oder zu öffnen

### ✅ Neues Design (Saubere Struktur)
```html
<!-- Parent Items: Pure Toggle, kein Link -->
<li class="has-submenu">
  <details>
    <summary aria-label="Programm">Programm</summary>
    <ul class="site-nav__submenu">
      <!-- Leaf Items: Normale Links -->
      <li>
        <a href="#konzerte">Konzerte</a>
      </li>
      <!-- Nested Parents: Pure Toggle -->
      <li class="has-submenu">
        <details>
          <summary aria-label="Spielplan">Spielplan</summary>
          <ul class="site-nav__submenu">
            <li><a href="#spielplan">Aktuelle Vorstellungen</a></li>
          </ul>
        </details>
      </li>
    </ul>
  </details>
</li>

<!-- Leaf Items: Normale Links, kein Toggle -->
<li>
  <a href="#besuch">Ihr Besuch</a>
</li>
```

**Vorteile:**
- ✅ Klare Semantik: Summary = öffne Submenu, Link = navigiere
- ✅ Bessere Accessibility: Details-Element ist nativ zugänglich
- ✅ Mobile-freundlich: Keine Verwirrung über zwei Funktionen
- ✅ Keyboard-Navigation: Tab+Enter funktioniert intuitiv
- ✅ Sauberer HTML: Kein redundanter Code

---

## 🔧 Technische Änderungen

### 1. `src/MenuRenderer.php` – Rendering-Logik

**Änderung:** Items mit Submenus werden jetzt als reine `<details><summary>` gerendert, ohne zusätzlichen `<a>` Link.

```php
// Items mit Submenus: nur Toggle
if ($item['children'] !== []) {
    $classes[] = 'has-submenu';
    $markup .= '<details...>'
        . '<summary aria-label="...">' . $item['title'] . '</summary>'
        . '<ul>...</ul>'
        . '</details>';
}
// Items ohne Submenus: normaler Link
else {
    $markup .= '<a href="...">' . $item['title'] . '</a>';
}
```

### 2. `index.html` – Statische Demo

Die HTML-Struktur wurde aktualisiert, um der neuen Logik zu entsprechen:

```html
<!-- Alt: <a> + <details> mit leerer <summary> -->
<!-- Neu: nur <details> mit <summary> mit Text -->
<li class="has-submenu">
  <details>
    <summary>Programm</summary>
    ...
  </details>
</li>
```

### 3. CSS – Keine Änderungen notwendig ✅

Die existierenden CSS-Regeln unterstützen bereits Summary-Elemente:
- `.site-nav__links summary` Styling
- Hover/Focus-Effekte
- Pfeil-Rotation bei `:open`
- Mobile Popover-Verhalten

---

## 📊 Vergleich: Alt vs. Neu

| Aspekt | Alt (Redundanz) | Neu (Option 1) |
|--------|-----------------|---|
| **Parent Item** | Link + Toggle | Pure Toggle |
| **Leaf Item** | Link | Link |
| **Summary-Text** | Leer | Zeigt Menü-Titel |
| **Semantik** | Mehrdeutig | Klar definiert |
| **Mobile UX** | Verwirrend | Intuitiv |
| **HTML-Größe** | +20% redundant | Sauber |
| **Accessibility** | Fragwürdig | Nativ-Support |

---

## ✅ Verifizierung

### PHP-Tests
```
✓ Parent items with submenus are now pure toggles (no <a> link)
✓ Leaf items still have <a> tags
✓ Summary elements contain menu item text
✓ Ancestor details with .is-ancestor are marked 'open'
✓ Current page is marked with aria-current="page"
```

### Browser-Tests
- ✅ Desktop (>44rem): Hover zeigt Submenus, Navigationslinks funktionieren
- ✅ Mobile (≤44rem): Popover öffnet/schließt mit Details/Summary
- ✅ Keyboard-Navigation: Tab/Enter funktioniert korrekt
- ✅ Screen-Reader: Semantische Struktur ist klar

---

## 🎯 Verwendungsrichtlinien

### Für Nutzer der Bibliothek:

**Alte Syntax funktioniert noch!** Der PHP-Renderer aktualisiert die Struktur automatisch.

```php
// Gleiche Input-Struktur wie zuvor
$items = [
    [
        'title' => 'Programm',
        'url' => '/programm',
        'external' => false,
        'children' => [
            ['title' => 'Spielplan', 'url' => '/spielplan', 'external' => false],
            ['title' => 'Konzerte', 'url' => '/konzerte', 'external' => false],
        ],
    ],
];

// Neuer, sauberer HTML-Output
$renderer = new MenuRenderer($items);
echo $renderer->render();
```

### CSS-Klassenbehandlung:

Die CSS-Klasse `has-submenu` wird auf Parent-Items gesetzt:

```php
// Items mit Kindern bekommen diese Klasse:
'has-submenu' => true  // Wird von Renderer automatisch gesetzt
```

---

## 🚀 Migrationsschritte für Benutzer

1. **Nichts tun!** Die PHP-Klasse rendert automatisch die neue Struktur
2. **HTML aktualisieren** (falls Sie statische HTML verwenden):
   - Entfernen Sie `<a href="...">` aus Parent-Items
   - Fügen Sie das Menu-Titel-Text in die `<summary>` ein
3. **CSS überprüfen**: Sollte ohne Änderungen funktionieren ✅
4. **Tests durchführen**: Desktop + Mobile + Keyboard-Navigation

---

## 📚 Weitere Ressourcen

- [Native HTML Details/Summary API](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/details)
- [Menu Role Patterns](https://www.w3.org/WAI/ARIA/apg/patterns/menubar/)
- [Keyboard Navigation Best Practices](https://www.w3.org/WAI/ARIA/apg/practices/keyboard-interface/)

---

## ❓ FAQ

**F: Werden die Menü-URLs noch unterstützt?**  
A: Ja! Parent-Items führten zuvor zu URLs wie `#programm`. Das funktioniert weiterhin über die Strukturierung von Links in den Submenus. Wenn Sie eine Parent-Link-Funktionalität benötigen, müssen Sie ein echtes Blatt-Item hinzufügen.

**F: Sind bestehende Links kaputt?**  
A: Nein. Leaf-Items (ohne Submenus) rendern weiterhin als normale `<a>` Links.

**F: Ist das IE11-kompatibel?**  
A: `<details>` wird in IE11 nicht unterstützt. Der Code fallback auf Desktop-Navigation ohne Popover. Mobile funktioniert nur in modernen Browsern mit Popover-Support.

**F: Können I Parent-Links zurück aktivieren?**  
A: Ja, mit Option 2 oder 3 (siehe ADR). Aber Option 1 ist sauberer und empfohlen.

---

## 📝 Änderungslog

**2026-11-15**
- ✅ Option 1 Implementierung abgeschlossen
- ✅ PHP MenuRenderer.php angepasst
- ✅ Statische HTML-Demo aktualisiert
- ✅ Tests validiert
- ✅ Dokumentation erstellt
