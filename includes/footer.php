<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/MenuItems.php';

$footerItems = $footerItems ?? require __DIR__ . '/../config/footer-menu.php';
$footerCopyright = $footerCopyright ?? 'Kammeroper Augsburg';

if (!is_array($footerItems)) {
    throw new InvalidArgumentException('Footer menu items must be a list.');
}
$validatedFooterItems = MenuItems::validate($footerItems, 1);
?>
<footer class="site-footer">
  <div class="site-footer__content">
    <nav class="site-footer__nav" aria-label="Footer-Navigation">
      <ul class="site-footer__links">
        <?php foreach ($validatedFooterItems as $item): ?>
          <li><?= MenuItems::renderLink($item) ?></li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <p class="site-footer__copyright">© <?= date('Y') ?> <?= MenuItems::escape($footerCopyright) ?></p>
  </div>
</footer>
