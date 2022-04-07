<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

return render(
    'over-mij',
    [
        'title' => 'Over mij - Delight Coachingpraktijk',
        'meta' => [
            'description' => 'Wie ben ik en waarom kan ik jou verder helpen?'
        ],
        'social' => [
            'image' => [
                'pattern' => 'img/photos/over_mij_hero-*x*.*',
                'alt' => 'Anja kijkt naar jou.'
            ]
        ]
    ]
);
