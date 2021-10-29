<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

class ImageDimensionsValidator implements ImageValidatorInterface
{
    public function __construct(
        private int $minWidth,
        private int $minHeight,
        private ?int $maxWidth = null,
        private ?int $maxHeight = null
    ) {}

    public function validate(Image $image): ?ImageException
    {
        $result = null;

        if ($image->width < $this->minWidth
            || $image->height < $this->minHeight
        ) {
            $result = new ImageException(
                sprintf(
                    'Image dimensions are below minimum of %dx%d',
                    $this->minWidth,
                    $this->minHeight
                ),
                $image
            );
        }

        if ($result === null
            && ($this->maxWidth !== null && $this->maxHeight !== null)
            && (
                $image->width > $this->maxWidth
                || $image->height > $this->maxHeight
            )
        ) {
            $result = new ImageException(
                sprintf(
                    'Image dimensions exceed maximum of %dx%d',
                    $this->maxWidth,
                    $this->maxHeight
                ),
                $image
            );
        }

        return $result;
    }
}
