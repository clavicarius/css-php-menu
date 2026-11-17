<?php

declare(strict_types=1);

return [
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
