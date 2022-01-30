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
                'pattern' => 'img/photos/life-coach_hero-*x*.*',
                'alt' => 'Anja en partner kijken naar de toekomst'
            ]
        ],
        'diplomas' => [
            [
                'level' => 'Life coach',
                'thumbnail' => 'img/diplomas/life-coach.jpg',
                'description' => <<<DESCRIPTION
                Je leert in de cursus Life Coach alle aspecten die essentieel zijn om mensen goed te begeleiden en coachen.
                Van de rol van de life coach tot gedragsverandering, verslavingsproblematiek, relationele zaken en stress: leer hoe je met de dingen des levens omgaat en mensen helpt in de rol van life coach.
                DESCRIPTION
            ]
        ]
    ]
);
