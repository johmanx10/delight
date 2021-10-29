<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

class TwitterCardFilter implements ImageFilterInterface
{
    public function __construct(
        private string $card,
        private ImageValidatorInterface $validator
    ) {}

    public function filterImages(array $context, Image ...$images): array
    {
        $result = $images;

        if (($context['social']['twitter:card'] ?? '') === $this->card) {
            $result = array_filter(
                $result,
                fn (Image $image) => $this->validator->validate($image) === null
            );
        }

        return $result;
    }
}
