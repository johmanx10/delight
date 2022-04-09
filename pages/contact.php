<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

return render(
    'contact',
    [
        'title' => 'Contact - Delight Coachingpraktijk',
        'meta' => [
            'description' => 'Neem contact op met Delight Coachingpraktijk.'
        ],
        'social' => [
            'image' => [
                'pattern' => 'img/map/office-*x*.*',
                'alt' => 'Kantoor van Delight Coachingpraktijk.'
            ]
        ]
    ]
);
