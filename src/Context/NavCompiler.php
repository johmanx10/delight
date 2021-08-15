<?php

declare(strict_types=1);

namespace Delight\Website\Context;

use Delight\Website\ContextCompilerInterface;

class NavCompiler implements ContextCompilerInterface
{
    public const NAV_KEY = 'nav';

    public function __construct(private array $layout) {}

    public function compile(array $context): array
    {
        return array_replace_recursive(
            [self::NAV_KEY => $this->layout],
            $context
        );
    }
}
