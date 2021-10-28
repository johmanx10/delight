<?php

declare(strict_types=1);

namespace Delight\Website\Context;

use Delight\Website\ContextCompilerInterface;

final class FaviconCompiler implements ContextCompilerInterface
{
    public function __construct(
        private string $root,
        private string $pattern,
        private string $rel = 'icon'
    ) {}

    public function compile(array $context): array
    {
        $favicons = $context['favicons'] ?? [];
        $files = glob(
            sprintf(
                '%s/%s',
                rtrim($this->root, '/'),
                ltrim($this->pattern, '/')
            ),
            GLOB_NOSORT
        ) ?: [];

        foreach ($files as $file) {
            $attributes = getimagesize($file);
            [$width, $height] = $attributes;
            $favicons[] = [
                'rel' => $this->rel,
                'href' => ltrim(
                    str_replace($this->root, '', $file),
                    '/'
                ),
                'sizes' => sprintf('%dx%d', $width, $height),
                'type' => $attributes['mime']
            ];
        }

        $context['favicons'] = $favicons;

        return $context;
    }
}
