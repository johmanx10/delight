<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

class FacebookShareFilter implements ImageFilterInterface
{
    public function __construct(private ImageValidatorInterface $validator) {}

    public function filterImages(array $context, Image ...$images): array
    {
        return array_filter(
            $images,
            fn (Image $image) => $this->validator->validate($image) === null
        );
    }
}
