<?php

declare(strict_types=1);

require_once __DIR__ . '/MenuItems.php';

final class MenuRenderer
{
    private array $items;

    public function __construct(array $items, private readonly string $label = 'Hauptnavigation')
    {
        if (trim($this->label) === '') {
            throw new InvalidArgumentException('The navigation label must not be empty.');
        }

        $this->items = MenuItems::validate($items);
    }

    public function render(string $currentUrl = '/'): string
    {
        $currentPath = self::normalizePath($currentUrl);
        [$itemsMarkup] = $this->renderItems($this->items, $currentPath);

        return '<nav class="site-nav" aria-label="' . MenuItems::escape($this->label) . '">'
            . '<button class="site-nav__toggle" type="button" aria-controls="site-nav-panel" '
            . 'aria-expanded="false" popovertarget="site-nav-panel">'
            . 'Menü öffnen</button>'
            . '<div class="site-nav__panel" id="site-nav-panel" popover="auto">'
            . '<button class="site-nav__close" type="button" popovertarget="site-nav-panel" '
            . 'popovertargetaction="hide">Menü schließen</button>'
            . '<ul class="site-nav__links">' . $itemsMarkup . '</ul>'
            . '</div>'
            . '</nav>';
    }

    private function renderItems(array $items, string $currentPath, int $depth = 1): array
    {
        $markup = '';
        $containsCurrent = false;

        foreach ($items as $item) {
            $itemPath = self::normalizePath($item['url']);
            $isCurrent = !$item['external'] && $itemPath === $currentPath;
            [$childrenMarkup, $hasCurrentDescendant] = $this->renderItems(
                $item['children'],
                $currentPath,
                $depth + 1,
            );
            $isAncestor = $hasCurrentDescendant
                || (!$item['external'] && self::isPathAncestor($itemPath, $currentPath));
            $containsCurrent = $containsCurrent || $isCurrent || $hasCurrentDescendant;

            $classes = ['site-nav__item'];
            if ($isCurrent) {
                $classes[] = 'is-current';
            }
            if ($isAncestor) {
                $classes[] = 'is-ancestor';
            }
            if ($item['children'] !== []) {
                $classes[] = 'has-submenu';
            }

            $markup .= '<li class="' . MenuItems::escape(implode(' ', $classes)) . '">';

            if ($item['children'] !== []) {
                $details = $hasCurrentDescendant ? ' open' : '';
                $title = MenuItems::escape($item['title']);
                $markup .= '<details' . $details . ' name="site-nav-level-' . $depth . '">'
                    . '<summary aria-label="' . $title . '">' . $title . '</summary>'
                    . '<ul class="site-nav__submenu">' . $childrenMarkup . '</ul></details>';
            } else {
                $markup .= MenuItems::renderLink($item, $isCurrent);
            }

            $markup .= '</li>';
        }

        return [$markup, $containsCurrent];
    }

    private static function normalizePath(string $url): string
    {
        $parts = parse_url($url);
        if ($parts === false) {
            throw new InvalidArgumentException('The current URL is invalid.');
        }

        $path = $parts['path'] ?? '/';
        $segments = [];
        foreach (explode('/', $path) as $segment) {
            if ($segment === '') {
                continue;
            }

            $segment = rawurldecode($segment);
            if ($segment === '.') {
                continue;
            }
            if ($segment === '..') {
                array_pop($segments);
                continue;
            }
            $segments[] = str_replace('/', '%2F', $segment);
        }

        return $segments === [] ? '/' : '/' . implode('/', $segments);
    }

    private static function isPathAncestor(string $ancestor, string $path): bool
    {
        return $ancestor !== '/' && str_starts_with($path, $ancestor . '/');
    }
}
