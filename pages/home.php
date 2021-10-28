<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

return render(
    'home',
    [
        'title' => 'Delight Coachingpraktijk',
        'meta' => [
            'description' => <<<DESCRIPTION
            Je voelt je onbegrepen en overgevoelig. Ik ben er voor je om dieper te gaan kijken. Die doe ik door lifecoaching, holistische technieken en reiki te combineren.
            DESCRIPTION
        ],
        'social' => [
            'image' => [
                'pattern' => 'img/photos/home_hero-*x*.*',
                'alt' => 'Anja op het strand, wijzend naar de verte'
            ]
        ]
    ]
);
