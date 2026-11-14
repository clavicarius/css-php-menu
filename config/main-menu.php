<?php

declare(strict_types=1);

return [
    [
        'title' => 'Startseite',
        'url' => '/',
        'external' => false,
    ],
    [
        'title' => 'Spielplan',
        'url' => '/spielplan',
        'external' => false,
        'children' => [
            [
                'title' => 'Aktuelle Spielzeit',
                'url' => '/spielplan/aktuell',
                'external' => false,
            ],
            [
                'title' => 'Archiv',
                'url' => '/spielplan/archiv',
                'external' => false,
            ],
        ],
    ],
    [
        'title' => 'Besuch',
        'url' => '/besuch',
        'external' => false,
        'children' => [
            [
                'title' => 'Tickets',
                'url' => '/besuch/tickets',
                'external' => false,
            ],
            [
                'title' => 'Anfahrt',
                'url' => '/besuch/anfahrt',
                'external' => false,
            ],
        ],
    ],
    [
        'title' => 'Über uns',
        'url' => '/ueber-uns',
        'external' => false,
    ],
    [
        'title' => 'Kontakt',
        'url' => '/kontakt',
        'external' => false,
    ],
];
