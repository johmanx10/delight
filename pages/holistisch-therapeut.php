<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

return render(
    'holistisch-therapeut',
    [
        'title' => 'Holistisch therapeut - Delight Coachingpraktijk',
        'meta' => [
            'description' => 'Wat is nou precies een holistisch therapeut en wat kan een reden zijn om naar een holistisch therapeut toe te gaan.'
        ],
        'social' => [
            'image' => [
                'pattern' => 'img/photos/holistisch_therapeut_hero-*x*.*',
                'alt' => 'Anja lacht naar partner'
            ]
        ]
    ]
);
