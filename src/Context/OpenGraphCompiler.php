<?php

declare(strict_types=1);

namespace Delight\Website\Context;

use Delight\Website\ContextCompilerInterface;
use Delight\Website\OpenGraph\Image;
use Delight\Website\OpenGraph\ImageException;
use Delight\Website\OpenGraph\ImageFactory;
use Delight\Website\OpenGraph\ImageFilterInterface;

final class OpenGraphCompiler implements ContextCompilerInterface
{
    public function __construct(
        private string $root,
        private ImageFactory $imageFactory,
        private ImageFilterInterface $imageFilter
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
            $images = $this->findImages(
                $context,
                $context['social']['image']['pattern'],
                $context['social']['image']['alt']
            );

            if (count($images) > 0) {
                $graph['og:image'] = array_merge(
                    $graph['og:image'] ?? [],
                    $images
                );
            }
        }

        return $graph;
    }

    private function findImages(
        array $context,
        string $pattern,
        string $alt
    ): array {
        $images = $this->imageFilter->filterImages(
            $context,
            ...array_reduce(
                glob(
                    sprintf(
                        '%s/%s',
                        rtrim($this->root, '/'),
                        ltrim($pattern, '/')
                    )
                ) ?: [],
                function (array $carry, string $file) use($alt): array {
                    try {
                        $carry[] = $this->imageFactory->createImage($file, $alt);
                    } catch (ImageException) {
                        // Ignore this image.
                    }

                    return $carry;
                },
                []
            )
        );

        // Sort images by dimensions.
        usort(
            $images,
            fn (Image $a, Image $b) => (
                // Hoist the largest image in dimensions.
                $b->getNumPixels() <=> $a->getNumPixels()
            )
        );

        // Only return 1 image per type.
        return array_values(
            array_reduce(
                $images,
                fn (array $carry, Image $image) => array_replace(
                    [$image->type => $image],
                    $carry
                ),
                []
            )
        );
    }
}
