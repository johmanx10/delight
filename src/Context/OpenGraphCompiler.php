<?php

declare(strict_types=1);

namespace Delight\Website\Context;

use Delight\Website\ContextCompilerInterface;

final class OpenGraphCompiler implements ContextCompilerInterface
{
    private const IMAGE_MIN_WIDTH = 600;
    private const IMAGE_MIN_HEIGHT = 315;
    private const IMAGE_MAX_SIZE = 1024 ** 2; // 1 MB

    public function __construct(
        private string $root,
        private string $website,
        private int $maxImages = 1
    ) {}

    public function compile(array $context): array
    {
        $context['social'] = array_replace_recursive(
            $this->compileOpenGraph($context),
            $context['social'] ?? []
        );

        return $context;
    }

    private function compileOpenGraph(array $context): array
    {
        $graph = [
            'og:title' => $context['title'] ?? '',
            'og:description' => $context['meta']['description'] ?? '',
            'og:url' => $context['meta']['canonical'] ?? '',
        ];

        if (isset($context['social']['image']['pattern'])
            && isset($context['social']['image']['alt'])
        ) {
            $graph = array_replace_recursive(
                $graph,
                $this->findImages(
                    $context['social']['image']['pattern'],
                    $context['social']['image']['alt']
                )
            );
        }

        return $graph;
    }

    private function findImages(string $pattern, string $alt): array
    {
        $images = [];
        $files = glob(
            sprintf(
                '%s/%s',
                rtrim($this->root, '/'),
                ltrim($pattern, '/')
            )
        ) ?: [];

        foreach ($files as $file) {
            $size = filesize($file);

            // Only proceed when the file size is agreeable.
            if ($size === 0 || $size > self::IMAGE_MAX_SIZE) {
                continue;
            }

            $attributes = getimagesize($file);

            // Only proceed when the file is an image file.
            if (!str_starts_with($attributes['mime'] ?? '', 'image/')) {
                continue;
            }

            [$width, $height] = $attributes;

            // Only proceed when the dimensions of the image are within bounds.
            if ($width < self::IMAGE_MIN_WIDTH
                || $height < self::IMAGE_MIN_HEIGHT
            ) {
                continue;
            }

            $images[] = [
                'og:image' => sprintf(
                    '%s/%s',
                    rtrim($this->website, '/'),
                    ltrim(str_replace($this->root, '', $file), '/')
                ),
                'og:image:type' => $attributes['mime'],
                'og:image:width' => $width,
                'og:image:height' => $height,
                'og:image:alt' => $alt,
                'size' => $size,
                'pixels' => $width * $height
            ];
        }

        usort(
            $images,
            fn (array $a, array $b) => (
                // Hoist the largest image in dimensions.
                $b['pixels'] <=> $a['pixels']
                // Penalize file size.
                ?: $a['size'] <=> $b['size']
            )
        );

        $images = array_reduce(
            array_slice($images, 0, $this->maxImages),
            fn (array $carry, array $image) => array_merge(
                $carry,
                [
                    array_filter(
                        $image,
                        fn (string $key) => str_starts_with($key, 'og:image'),
                        ARRAY_FILTER_USE_KEY
                    )
                ]
            ),
            []
        );

        return (
            count($images) === 1
                ? reset($images)
                : ['og:image' => $images]
        );
    }
}
