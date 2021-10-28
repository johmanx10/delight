<?php

declare(strict_types=1);

use Delight\Website\SRI\SubResource;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Extra\String\StringExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

$environment = new Environment(
    new FilesystemLoader(
        __DIR__ . '/../templates'
    ),
    TEMPLATE_OPTIONS
);

$environment->addExtension(new DebugExtension());
$environment->addExtension(new StringExtension());
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
        'sri',
        fn (string $filename, string $algo = null) => new SubResource(
            $algo ?? SubResource::ALGO_SHA256,
            new SplFileInfo(__DIR__ . '/../public/' . $filename)
        )
    )
);

$slugger = new AsciiSlugger();

foreach (range(1, 6) as $level) {
    $environment->addFunction(
        new TwigFunction(
            sprintf('h%d', $level),
            fn (string $text) => sprintf(
                '<h%1$d id="%3$s"><a class="anchor" href="#%3$s" aria-hidden="true"></a>%2$s</h%1$d>',
                $level,
                $text,
                $slugger->slug(strtolower($text))
            ),
            ['is_safe' => ['html']]
        )
    );
}

return $environment;
