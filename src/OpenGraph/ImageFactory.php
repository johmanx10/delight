<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

final class ImageFactory
{
    public function __construct(
        private string $root,
        private string $website,
        private ?ImageValidatorInterface $validator = null
    ) {
        $this->validator ??= new ImageValidatorChain();
    }

    /**
     * @param string $file
     * @param string $alt
     * @return Image
     * @throws ImageException When the created image could not be validated.
     */
    public function createImage(string $file, string $alt): Image
    {
        $attributes = getimagesize($file);
        [$width, $height] = $attributes;

        $image = new Image(
            url: sprintf(
                     '%s/%s',
                     rtrim($this->website, '/'),
                     ltrim(str_replace($this->root, '', $file), '/')
                 ),
            type: $attributes['mime'],
            alt: $alt,
            width: $width,
            height: $height,
            size: filesize($file)
        );

        $exception = $this->validator->validate($image);
        if ($exception !== null) {
            throw $exception;
        }

        return $image;
    }
}
