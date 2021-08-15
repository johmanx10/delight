<?php

declare(strict_types=1);

namespace Delight\Website\Context;

use Delight\Website\ContextCompilerInterface;

class DefaultsCompiler implements ContextCompilerInterface
{
    public function __construct(private string $pathToDefaults) {}

    public function compile(array $context): array
    {
        return array_replace_recursive(
            json_decode(
                json: file_get_contents($this->pathToDefaults),
                associative: true,
                flags: JSON_THROW_ON_ERROR
            ),
            $context
        );
    }
}
