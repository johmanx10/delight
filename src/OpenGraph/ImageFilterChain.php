<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

class ImageFilterChain implements ImageFilterInterface
{
    /** @var ImageFilterInterface[] */
    private array $filters;

    public function __construct(ImageFilterInterface ...$filters)
    {
        $this->filters = $filters;
    }

    public function filterImages(array $context, Image ...$images): array
    {
        return array_reduce(
            $this->filters,
            fn (array $carry, ImageFilterInterface $filter) => (
                $filter->filterImages($context, ...$carry)
            ),
            $images
        );
    }
}
