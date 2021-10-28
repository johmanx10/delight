<?php

declare(strict_types=1);

namespace Delight\Website\Twig;

use Delight\Website\SRI\SubResource;
use SplFileInfo;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SubresourceIntegrityExtension extends AbstractExtension
{
    public function __construct(
        private string $root,
        private string $defaultAlgo = SubResource::ALGO_SHA256
    ) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('sri', [$this, 'createSubResource'])
        ];
    }

    public function createSubResource(
        string $filename,
        string $algo = null
    ): SubResource {
        return new SubResource(
            $algo ?? $this->defaultAlgo,
            new SplFileInfo(
                sprintf(
                    '%s/%s',
                    rtrim($this->root, '/'),
                    ltrim($filename, '/')
                )
            )
        );
    }
}
