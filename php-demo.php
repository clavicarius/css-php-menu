<?php

declare(strict_types=1);

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
  <?php require __DIR__ . '/includes/header.php'; ?>
  <main>
    <h1>PHP-Menü-Demo</h1>
    <p>Diese Seite zeigt die PHP-generierte Navigation mit drei Ebenen und einem Footer.</p>
    <p>Die Menü-URLs sind Beispiele und müssen für das eigene Projekt angepasst werden.</p>
  </main>
  <?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
