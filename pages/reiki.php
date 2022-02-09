<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

return render(
    'reiki',
    [
        'title' => 'Reiki - Delight Coachingpraktijk',
        'meta' => [
            'description' => 'Wat is Reiki? Wat kun je verwachten van Reiki en wat gebeurt er tijdens een behandeling?'
        ],
        'social' => [
            'image' => [
                'pattern' => 'img/photos/reiki_hero-*x*.*',
                'alt' => 'Anja met arm om schouders van partner'
            ]
        ]
    ]
);
