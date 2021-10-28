<?php

declare(strict_types=1);

use Delight\Website\Context\CanonicalCompiler;
use Delight\Website\Context\DefaultsCompiler;
use Delight\Website\Context\FaviconCompiler;
use Delight\Website\Context\NavCompiler;
use Delight\Website\Context\PageCompiler;
use Delight\Website\ContextCompilerInterface;

return new class (
    new DefaultsCompiler(__DIR__ . '/../config/defaults.json'),
    new PageCompiler(PAGES),
    new NavCompiler(NAV_LAYOUT),
    new FaviconCompiler(__DIR__ . '/../public/', 'img/favicons/favicon.ico'),
    new FaviconCompiler(__DIR__ . '/../public/', 'img/favicons/favicon-*.png'),
    new FaviconCompiler(__DIR__ . '/../public/', 'img/favicons/apple-touch-icon.png', 'apple-touch-icon'),
    new CanonicalCompiler(WEBSITE)
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
            fn (array $carry, ContextCompilerInterface $compiler) => (
                $compiler->compile($carry)
            ),
            $context
        );
    }
};
