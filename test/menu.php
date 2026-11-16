<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/MenuRenderer.php';

function check(bool $condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

function expectInvalid(callable $operation): void
{
    try {
        $operation();
    } catch (InvalidArgumentException $exception) {
        return;
    }

    throw new RuntimeException('Invalid menu data was accepted.');
}

$external = ['title' => 'A & B', 'url' => 'https://example.com/?a=1&b=2', 'external' => true];
$items = [[
    'title' => 'Programm',
    'url' => '/programm',
    'external' => false,
    'children' => [
        ['title' => 'Aktuell', 'url' => '/programm/aktuell', 'external' => false],
        $external,
    ],
]];

$markup = (new MenuRenderer($items))->render('/programm/aktuell/');
check(str_contains($markup, '<details open name="site-nav-level-1">'), 'Current ancestor must be open.');
check(str_contains($markup, 'href="/programm/aktuell" aria-current="page"'), 'Current link must be marked.');
check(str_contains($markup, 'href="https://example.com/?a=1&amp;b=2"'), 'Link URL must be escaped.');
check(str_contains($markup, 'aria-label="A &amp; B (öffnet in neuem Tab)"'), 'External link must be labelled.');
check(str_contains($markup, 'target="_blank" rel="noopener noreferrer"'), 'External link must be safe.');

$footerItems = [$external];
$footerCopyright = '<Test & Co>';
ob_start();
require __DIR__ . '/../includes/footer.php';
$footer = ob_get_clean();
check(str_contains($footer, MenuItems::renderLink($external)), 'Footer and navigation must render links consistently.');
check(str_contains($footer, '&lt;Test &amp; Co&gt;'), 'Footer copyright must be escaped.');
ob_start();
require __DIR__ . '/../includes/footer.php';
ob_end_clean();

foreach (['javascript:alert(1)', '//example.com', 'https://user:pass@example.com/', '/bad path'] as $url) {
    $invalidItem = ['title' => 'Test', 'url' => $url, 'external' => false];
    expectInvalid(static fn () => new MenuRenderer([$invalidItem]));
    expectInvalid(static fn () => MenuItems::validate([$invalidItem], 1));
}
expectInvalid(static fn () => MenuItems::validate($items, 1));
expectInvalid(static fn () => new MenuRenderer([['title' => 'Test', 'url' => '/', 'external' => 'false']]));

$nested = ['title' => 'Test', 'url' => '/', 'external' => false];
for ($depth = 0; $depth < 3; $depth++) {
    $nested = ['title' => 'Parent', 'url' => '/', 'external' => false, 'children' => [$nested]];
}
expectInvalid(static fn () => new MenuRenderer([$nested]));

echo "Menu tests passed.\n";
