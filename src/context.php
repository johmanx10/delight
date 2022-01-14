<?php

declare(strict_types=1);

use Delight\Website\Context\CanonicalCompiler;
use Delight\Website\Context\DefaultsCompiler;
use Delight\Website\Context\FaviconCompiler;
use Delight\Website\Context\NavCompiler;
use Delight\Website\Context\PageCompiler;
use Delight\Website\Context\OpenGraphCompiler;
use Delight\Website\ContextCompilerInterface;
use Delight\Website\OpenGraph\FacebookShareFilter;
use Delight\Website\OpenGraph\ImageFilterChain;
use Delight\Website\OpenGraph\TwitterCardFilter;

return new class (
    new DefaultsCompiler(__DIR__ . '/../config/defaults.json'),
    new PageCompiler(PAGES),
    new NavCompiler(NAV_LAYOUT),
    new FaviconCompiler(WEB_ROOT, 'img/favicons/favicon.ico'),
    new FaviconCompiler(WEB_ROOT, 'img/favicons/favicon-*.png'),
    new FaviconCompiler(WEB_ROOT, 'img/favicons/apple-touch-icon.png', 'apple-touch-icon'),
    new CanonicalCompiler(WEBSITE),
    new OpenGraphCompiler(
        WEB_ROOT,
        require __DIR__ . '/../services/open-graph/image-factory.php',
        new ImageFilterChain(
            new TwitterCardFilter(
                'summary',
                require __DIR__ . '/../services/open-graph/image/validator/twitter/summary.php'
            ),
            new TwitterCardFilter(
                'summary_large_image',
                require __DIR__ . '/../services/open-graph/image/validator/twitter/summary_large_image.php'
            ),
            new FacebookShareFilter(
                require __DIR__ . '/../services/open-graph/image/validator/facebook.php'
            )
        )
    )
) implements ContextCompilerInterface {
    private array $compilers;

    public function __construct(ContextCompilerInterface ...$compilers)
    {
        $this->compilers = $compilers;
    }

    public function compile(array $context): array
    {
        return array_reduce(
            $this->compilers,
            static fn (array $carry, ContextCompilerInterface $compiler) => (
                $compiler->compile($carry)
            ),
            $context
        );
    }
};
