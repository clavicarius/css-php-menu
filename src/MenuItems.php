<?php

declare(strict_types=1);

final class MenuItems
{
    public static function validate(array $items, int $maxDepth = 3, int $depth = 1): array
    {
        if (!array_is_list($items)) {
            throw new InvalidArgumentException('Menu items must be a list.');
        }

        $validated = [];
        foreach ($items as $index => $item) {
            $itemPath = 'Menu item ' . ($index + 1);
            if ($depth > $maxDepth) {
                throw new InvalidArgumentException('The menu exceeds the maximum depth.');
            }
            if (!is_array($item)) {
                throw new InvalidArgumentException($itemPath . ' must be an array.');
            }

            $allowedKeys = $maxDepth > 1 ? ['title', 'url', 'external', 'children'] : ['title', 'url', 'external'];
            if (array_diff(array_keys($item), $allowedKeys) !== []) {
                throw new InvalidArgumentException($itemPath . ' contains unsupported fields.');
            }
            foreach (['title', 'url', 'external'] as $key) {
                if (!array_key_exists($key, $item)) {
                    throw new InvalidArgumentException($itemPath . ' is missing "' . $key . '".');
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
            self::validateUrl($item['url']);

            if (array_key_exists('children', $item) && !is_array($item['children'])) {
                throw new InvalidArgumentException($itemPath . ' children must be an array.');
            }
            $validated[] = [
                'title' => $item['title'],
                'url' => $item['url'],
                'external' => $item['external'],
                'children' => self::validate($item['children'] ?? [], $maxDepth, $depth + 1),
            ];
        }

        return $validated;
    }

    private static function validateUrl(string $url): void
    {
        if (preg_match('/[\x00-\x20\x7f]/', $url) === 1) {
            throw new InvalidArgumentException('Menu URLs must not contain whitespace or control characters.');
        }

        $parts = parse_url($url);
        if ($parts === false) {
            throw new InvalidArgumentException('The menu URL is invalid.');
        }

        $scheme = strtolower($parts['scheme'] ?? '');
        if ($scheme !== '' && (!in_array($scheme, ['http', 'https'], true) || empty($parts['host']))) {
            throw new InvalidArgumentException('Menu URLs must use HTTP or HTTPS.');
        }
        if ($scheme === '' && (!str_starts_with($url, '/') || str_starts_with($url, '//'))) {
            throw new InvalidArgumentException('Menu URLs must be root-relative or absolute HTTP(S) URLs.');
        }
        if (isset($parts['user']) || isset($parts['pass'])) {
            throw new InvalidArgumentException('Menu URLs must not contain credentials.');
        }
    }

    public static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    public static function renderLink(array $item, bool $isCurrent = false): string
    {
        $attributes = ' href="' . self::escape($item['url']) . '"';
        if ($isCurrent) {
            $attributes .= ' aria-current="page"';
        }
        if ($item['external']) {
            $attributes .= ' target="_blank" rel="noopener noreferrer" aria-label="'
                . self::escape($item['title'] . ' (öffnet in neuem Tab)') . '"';
        }

        return '<a' . $attributes . '>' . self::escape($item['title'])
            . ($item['external'] ? ' <span aria-hidden="true">↗</span>' : '')
            . '</a>';
    }
}
