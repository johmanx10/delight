<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

return render(
    'home',
    [
        'title' => 'Delight Coachingpraktijk',
        'meta' => [
            'description' => 'Overzicht van redenen om gebruik te maken van Delight Coachingpraktijk.'
        ]
    ]
);
