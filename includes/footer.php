<?php

declare(strict_types=1);

$footerItems = require __DIR__ . '/../config/footer-menu.php';
$escape = static fn (string $value): string => htmlspecialchars(
    $value,
    ENT_QUOTES | ENT_SUBSTITUTE,
    'UTF-8',
);
$validateUrl = static function (string $url): void {
    if (preg_match('/[\x00-\x20\x7f]/', $url) === 1) {
        throw new InvalidArgumentException('Footer URLs must not contain whitespace or control characters.');
    }

    $parts = parse_url($url);
    if ($parts === false) {
        throw new InvalidArgumentException('A footer URL is invalid.');
    }

    $scheme = strtolower($parts['scheme'] ?? '');
    if ($scheme !== '' && (!in_array($scheme, ['http', 'https'], true) || empty($parts['host']))) {
        throw new InvalidArgumentException('Footer URLs must use HTTP or HTTPS.');
    }
    if ($scheme === '' && (!str_starts_with($url, '/') || str_starts_with($url, '//'))) {
        throw new InvalidArgumentException('Footer URLs must be root-relative or absolute HTTP(S) URLs.');
    }
    if (isset($parts['user']) || isset($parts['pass'])) {
        throw new InvalidArgumentException('Footer URLs must not contain credentials.');
    }
};

if (!is_array($footerItems) || !array_is_list($footerItems)) {
    throw new InvalidArgumentException('Footer menu items must be a list.');
}

foreach ($footerItems as $index => $item) {
    if (!is_array($item)) {
        throw new InvalidArgumentException('Footer menu item ' . ($index + 1) . ' must be an array.');
    }
    if (array_diff(array_keys($item), ['title', 'url', 'external']) !== []) {
        throw new InvalidArgumentException('Footer menu items contain unsupported fields.');
    }
    foreach (['title', 'url', 'external'] as $requiredKey) {
        if (!array_key_exists($requiredKey, $item)) {
            throw new InvalidArgumentException('Footer menu item ' . ($index + 1) . ' is missing "' . $requiredKey . '".');
        }
    }
    if (!is_string($item['title']) || trim($item['title']) === '') {
        throw new InvalidArgumentException('Footer menu item titles must be non-empty strings.');
    }
    if (!is_string($item['url']) || trim($item['url']) === '') {
        throw new InvalidArgumentException('Footer menu item URLs must be non-empty strings.');
    }
    if (!is_bool($item['external'])) {
        throw new InvalidArgumentException('Footer menu item external values must be booleans.');
    }

    $validateUrl($item['url']);
}
?>
<footer class="site-footer">
  <div class="site-footer__content">
    <nav class="site-footer__nav" aria-label="Footer-Navigation">
      <ul class="site-footer__links">
        <?php foreach ($footerItems as $item): ?>
          <li>
            <a href="<?= $escape($item['url']) ?>"<?php if ($item['external']): ?>
              target="_blank" rel="noopener noreferrer"
              aria-label="<?= $escape($item['title'] . ' (öffnet in neuem Tab)') ?>"
            <?php endif; ?>><?= $escape($item['title']) ?><?php if ($item['external']): ?>
              <span aria-hidden="true">↗</span>
            <?php endif; ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <p class="site-footer__copyright">© <?= date('Y') ?> Kammeroper Augsburg</p>
  </div>
</footer>
