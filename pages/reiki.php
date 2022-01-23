<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

return render(
    'reiki',
    [
        'title' => 'Reiki - Delight Coachingpraktijk',
        'meta' => [
            'description' => ''
        ],
        'social' => [
            'image' => [
                'pattern' => 'img/photos/reiki_hero-*x*.*',
                'alt' => 'Anja met arm om schouders van partner'
            ]
        ],
        'diplomas' => [
            [
                'level' => 'Reiki 1',
                'thumbnail' => 'img/diplomas/reiki1.jpg',
                'description' => 'Reiki 1 is gericht op het fysieke niveau. Het behandelen van lichamelijke klachten.'
            ],
            [
                'level' => 'Reiki 2',
                'thumbnail' => 'img/diplomas/reiki2.jpg',
                'description' => 'In Reiki 2 staan het mentale en emotionele niveau centraal. Vanuit intuïtie behandelen, door de energie door te laten stromen op de diepere niveaus.'
            ],
            [
                'level' => 'Reiki 3A',
                'thumbnail' => 'img/diplomas/reiki3.jpg',
                'description' => 'Als Reiki Master kan ik op alle holistische niveaus een Reiki behandeling geven.'
            ]
        ]
    ]
);
