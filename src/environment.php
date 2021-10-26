<?php

declare(strict_types=1);

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

$environment = new Environment(
    new FilesystemLoader(
        __DIR__ . '/../templates'
    ),
    TEMPLATE_OPTIONS
);

$environment->addExtension(new DebugExtension());
$environment->addFunction(
    new TwigFunction(
        'path',
        fn (string $route) => PAGES[$route]['path'] ?? ''
    )
);
$environment->addFunction(
    new TwigFunction(
        'url',
        fn (string $route) => sprintf(
            '%s/%s',
            rtrim(WEBSITE, '/'),
            ltrim(PAGES[$route]['path'] ?? '', '/')
        )
    )
);
$environment->addFunction(
    new TwigFunction(
        'label',
        fn (string $route) => PAGES[$route]['label'] ?? ''
    )
);

$environment->addFunction(
    new TwigFunction(
        'css',
        fn (string $filename) => sprintf(
            '<link rel="stylesheet" href="css/%s?v=%s" />',
            ltrim($filename, '/'),
            substr(
                sha1_file(__DIR__ . '/../public/css/' . $filename),
                0,
                8
            )
        ),
        ['is_safe' => ['html']]
    )
);

return $environment;
