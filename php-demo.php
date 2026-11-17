<?php

declare(strict_types=1);

require_once __DIR__ . '/src/MenuRenderer.php';

$items = [
    ['title' => 'Start', 'url' => '/', 'external' => false],
    [
        'title' => 'Programm',
        'url' => '/programm',
        'external' => false,
        'children' => [
            [
                'title' => 'Spielplan',
                'url' => '/programm/spielplan',
                'external' => false,
                'children' => [
                    ['title' => 'Vorstellungen', 'url' => '/programm/spielplan/vorstellungen', 'external' => false],
                    ['title' => 'Konzerte', 'url' => '/programm/spielplan/konzerte', 'external' => false],
                ],
            ],
            ['title' => 'Archiv', 'url' => '/programm/archiv', 'external' => false],
        ],
    ],
    ['title' => 'Kontakt', 'url' => '/kontakt', 'external' => false],
];

$footerItems = [
    ['title' => 'Kontakt', 'url' => '/kontakt', 'external' => false],
    ['title' => 'Impressum', 'url' => '/impressum', 'external' => false],
];
$footerCopyright = 'PHP-Menü-Demo';
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP-Menü-Demo</title>
  <link rel="stylesheet" href="css/menu.css">
  <script src="js/navigation.js" defer></script>
  <style>
    body {
      margin: 0;
      font: 1rem/1.5 system-ui, sans-serif;
    }

    .site-nav {
      padding-inline: 1rem;
    }

    main {
      min-height: 50vh;
      padding: 2rem 1rem;
    }
  </style>
</head>
<body>
  <header>
    <?= (new MenuRenderer($items))->render($_SERVER['REQUEST_URI'] ?? '/') ?>
  </header>
  <main>
    <h1>PHP-Menü-Demo</h1>
    <p>Diese Seite zeigt die PHP-generierte Navigation mit drei Ebenen und einem Footer.</p>
    <p>Die Menü-URLs sind Beispiele und müssen für das eigene Projekt angepasst werden.</p>
  </main>
  <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
