<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/MenuRenderer.php';

$mainMenuItems = $mainMenuItems ?? require __DIR__ . '/../config/main-menu.php';
$currentUrl = $currentUrl ?? ($_SERVER['REQUEST_URI'] ?? '/');

if (!is_array($mainMenuItems)) {
    throw new InvalidArgumentException('Main menu items must be a list.');
}
?>
<header>
  <?= (new MenuRenderer($mainMenuItems))->render($currentUrl) ?>
</header>
