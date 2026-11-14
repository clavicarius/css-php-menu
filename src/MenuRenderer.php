<?php

declare(strict_types=1);

final class MenuRenderer
{
    private const MAX_DEPTH = 3;

    private array $items;

    public function __construct(array $items, private readonly string $label = 'Hauptnavigation')
    {
        if (trim($this->label) === '') {
            throw new InvalidArgumentException('The navigation label must not be empty.');
        }

        $this->items = self::validateItems($items);
    }

    public function render(string $currentUrl = '/'): string
    {
        $currentPath = self::normalizePath($currentUrl);
        [$itemsMarkup] = $this->renderItems($this->items, $currentPath);

        return '<nav class="site-nav" aria-label="' . self::escape($this->label) . '">'
            . '<ul class="site-nav__links">' . $itemsMarkup . '</ul>'
            . '</nav>';
    }

    private static function validateItems(array $items, int $depth = 1): array
    {
        if (!array_is_list($items)) {
            throw new InvalidArgumentException('Menu items must be a list.');
        }

        $validated = [];

        foreach ($items as $index => $item) {
            $itemPath = 'menu item ' . ($index + 1);
            if ($depth > self::MAX_DEPTH) {
                throw new InvalidArgumentException('The menu must not exceed three levels.');
            }
            if (!is_array($item)) {
                throw new InvalidArgumentException($itemPath . ' must be an array.');
            }

            $unknownKeys = array_diff(array_keys($item), ['title', 'url', 'external', 'children']);
            if ($unknownKeys !== []) {
                throw new InvalidArgumentException($itemPath . ' contains unsupported fields.');
            }
            foreach (['title', 'url', 'external'] as $requiredKey) {
                if (!array_key_exists($requiredKey, $item)) {
                    throw new InvalidArgumentException($itemPath . ' is missing "' . $requiredKey . '".');
                }
            }
            if (!is_string($item['title']) || trim($item['title']) === '') {
                throw new InvalidArgumentException($itemPath . ' title must be a non-empty string.');
            }
            if (!is_string($item['url']) || trim($item['url']) === '') {
                throw new InvalidArgumentException($itemPath . ' URL must be a non-empty string.');
            }
            if (!is_bool($item['external'])) {
                throw new InvalidArgumentException($itemPath . ' external must be a boolean.');
            }
            self::validateUrl($item['url'], $itemPath);

            if (array_key_exists('children', $item) && !is_array($item['children'])) {
                throw new InvalidArgumentException($itemPath . ' children must be an array.');
            }
            $children = $item['children'] ?? [];

            $validated[] = [
                'title' => $item['title'],
                'url' => $item['url'],
                'external' => $item['external'],
                'children' => self::validateItems($children, $depth + 1),
            ];
        }

        return $validated;
    }

    private static function validateUrl(string $url, string $itemPath): void
    {
        if (preg_match('/[\x00-\x20\x7f]/', $url) === 1) {
            throw new InvalidArgumentException($itemPath . ' URL must not contain whitespace or control characters.');
        }

        $parts = parse_url($url);
        if ($parts === false) {
            throw new InvalidArgumentException($itemPath . ' URL is invalid.');
        }

        $scheme = strtolower($parts['scheme'] ?? '');
        if ($scheme !== '' && (!in_array($scheme, ['http', 'https'], true) || empty($parts['host']))) {
            throw new InvalidArgumentException($itemPath . ' URL must use HTTP or HTTPS.');
        }
        if ($scheme === '' && (!str_starts_with($url, '/') || str_starts_with($url, '//'))) {
            throw new InvalidArgumentException($itemPath . ' URL must be root-relative or an absolute HTTP(S) URL.');
        }
        if (isset($parts['user']) || isset($parts['pass'])) {
            throw new InvalidArgumentException($itemPath . ' URL must not contain credentials.');
        }
    }

    private function renderItems(array $items, string $currentPath): array
    {
        $markup = '';
        $containsCurrent = false;

        foreach ($items as $item) {
            $itemPath = self::normalizePath($item['url']);
            $isCurrent = !$item['external'] && $itemPath === $currentPath;
            [$childrenMarkup, $hasCurrentDescendant] = $this->renderItems($item['children'], $currentPath);
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

            $linkAttributes = ' href="' . self::escape($item['url']) . '"';
            if ($isCurrent) {
                $linkAttributes .= ' aria-current="page"';
            }
            if ($item['external']) {
                $linkAttributes .= ' target="_blank" rel="noopener noreferrer" aria-label="'
                    . self::escape($item['title'] . ' (öffnet in neuem Tab)') . '"';
            }

            $link = '<a' . $linkAttributes . '>' . self::escape($item['title']);
            if ($item['external']) {
                $link .= ' <span aria-hidden="true">↗</span>';
            }
            $link .= '</a>';

            $markup .= '<li class="' . self::escape(implode(' ', $classes)) . '">' . $link;
            if ($item['children'] !== []) {
                $details = $hasCurrentDescendant ? ' open' : '';
                $summaryLabel = 'Untermenü zu ' . $item['title'] . ' ein- oder ausblenden';
                $markup .= '<details' . $details . '><summary aria-label="'
                    . self::escape($summaryLabel) . '"><span aria-hidden="true">⌄</span></summary>'
                    . '<ul class="site-nav__submenu">' . $childrenMarkup . '</ul></details>';
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

    private static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
