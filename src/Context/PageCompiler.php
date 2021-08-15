<?php

declare(strict_types=1);

namespace Delight\Website\Context;

use Delight\Website\ContextCompilerInterface;

class PageCompiler implements ContextCompilerInterface
{
    public const PAGE_KEY = '_page';
    public const PAGES_KEY = 'pages';

    public function __construct(private array $pages) {}

    public function compile(array $context): array
    {
        return array_replace_recursive(
            [
                self::PAGES_KEY => $this->pages,
                self::PAGE_KEY => $this->pages[$context['_route']] ?? []
            ],
            $context
        );
    }
}
