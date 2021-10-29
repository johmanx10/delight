<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

class ImageSizeValidator implements ImageValidatorInterface
{
    public function __construct(private int $maxSize) {}

    public function validate(Image $image): ?ImageException
    {
        $result = null;

        if ($image->size > $this->maxSize) {
            $result = new ImageException(
                sprintf(
                    'Image exceeded maximum file size of %d.',
                    $this->maxSize
                ),
                $image
            );
        }

        return $result;
    }
}
