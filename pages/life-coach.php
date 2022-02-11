<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

return render(
    'life-coach',
    [
        'title' => 'Life coach - Delight Coachingpraktijk',
        'meta' => [
            'description' => 'Wat doet een live coach precies en waarom zou je daar voor willen kiezen?'
        ],
        'social' => [
            'image' => [
                'pattern' => 'img/photos/life_coach_hero-*x*.*',
                'alt' => 'Anja en partner kijken naar de toekomst'
            ]
        ]
    ]
);
