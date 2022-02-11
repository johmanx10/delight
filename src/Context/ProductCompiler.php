<?php

declare(strict_types=1);

namespace Delight\Website\Context;

use Delight\Website\ContextCompilerInterface;

class ProductCompiler implements ContextCompilerInterface
{
    public function __construct(
        private ContextCompilerInterface $durationCompiler
    ) {}

    public function compile(array $context): array
    {
        if (array_key_exists('products', $context)) {
            $context['products'] = array_map(
                fn (array $product) => $this->compileProduct($product),
                $context['products']
            );
        }

        return $context;
    }

    private function compileProduct(mixed $product): array
    {
        if (array_key_exists('duration', $product)) {
            $product = $this->durationCompiler->compile($product);
        }

        return $product;
    }
}
