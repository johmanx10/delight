<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

return render(
    'over-jou',
    [
        'title' => 'Over jou - Delight Coachingpraktijk',
        'meta' => [
            'description' => 'Wie jij bent en waarom Delight jou kan helpen.'
        ],
        'social' => [
            'image' => [
                'pattern' => 'img/photos/over_jou_hero-*x*.*',
                'alt' => 'Wandelend vooruit.'
            ]
        ]
    ]
);
