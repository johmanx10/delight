<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

return render(
    'home',
    [
        'title' => 'Delight Coachingpraktijk',
        'meta' => [
            'description' => 'Overzicht van redenen om gebruik te maken van Delight Coachingpraktijk.'
        ],
        'social' => [
            'image' => [
                'pattern' => 'img/photos/home_hero-*x*.*',
                'alt' => 'Anja op het strand, wijzend naar de verte'
            ]
        ]
    ]
);
