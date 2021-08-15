<?php

declare(strict_types=1);

namespace Delight\Website\Context;

use Delight\Website\ContextCompilerInterface;

class CanonicalCompiler implements ContextCompilerInterface
{
    public function __construct(private string $website) {}

    public function compile(array $context): array
    {
        if (!isset($context[PageCompiler::PAGE_KEY]['path'])) {
            return $context;
        }

        $website = rtrim($this->website, '/');
        $path = ltrim($context[PageCompiler::PAGE_KEY]['path'], '/');

        return array_replace_recursive(
            [
                'meta' => [
                    'canonical' => sprintf('%s/%s', $website, $path)
                ]
            ],
            $context
        );
    }
}
