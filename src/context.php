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
use Delight\Website\OpenGraph\ImageAspectRatioValidator;
use Delight\Website\OpenGraph\ImageDimensionsValidator;
use Delight\Website\OpenGraph\ImageFactory;
use Delight\Website\OpenGraph\ImageFilterChain;
use Delight\Website\OpenGraph\ImageSizeValidator;
use Delight\Website\OpenGraph\ImageTypeValidator;
use Delight\Website\OpenGraph\ImageValidatorChain;
use Delight\Website\OpenGraph\TwitterCardFilter;

$webRoot = __DIR__ . '/../public/';

return new class (
    new DefaultsCompiler(__DIR__ . '/../config/defaults.json'),
    new PageCompiler(PAGES),
    new NavCompiler(NAV_LAYOUT),
    new FaviconCompiler($webRoot, 'img/favicons/favicon.ico'),
    new FaviconCompiler($webRoot, 'img/favicons/favicon-*.png'),
    new FaviconCompiler($webRoot, 'img/favicons/apple-touch-icon.png', 'apple-touch-icon'),
    new CanonicalCompiler(WEBSITE),
    new OpenGraphCompiler(
        $webRoot,
        new ImageFactory(
            $webRoot,
            WEBSITE,
            new ImageTypeValidator('image/*')
        ),
        new ImageFilterChain(
            new TwitterCardFilter(
                'summary',
                new ImageValidatorChain(
                    new ImageTypeValidator('image/png', 'image/webp', 'image/jpeg', 'image/gif'),
                    new ImageDimensionsValidator(144, 144, 4096, 4096),
                    new ImageAspectRatioValidator(1),
                    new ImageSizeValidator(5 * 1024 ** 2)
                )
            ),
            new TwitterCardFilter(
                'summary_large_image',
                new ImageValidatorChain(
                    new ImageTypeValidator('image/png', 'image/webp', 'image/jpeg', 'image/gif'),
                    new ImageDimensionsValidator(300, 157, 4096, 4096),
                    new ImageAspectRatioValidator(2),
                    new ImageSizeValidator(5 * 1024 ** 2)
                )
            ),
            new FacebookShareFilter(
                new ImageValidatorChain(
                    new ImageTypeValidator('image/*'),
                    new ImageDimensionsValidator(200, 200),
                    new ImageAspectRatioValidator(1.91),
                    new ImageSizeValidator(8 * 1024 ** 2)
                )
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
