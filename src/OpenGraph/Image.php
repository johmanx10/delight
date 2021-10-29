<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

final class Image extends AbstractObject
{
    public function __construct(
        public string $url,
        public string $type,
        public string $alt,
        public int $width,
        public int $height,
        public int $size
    ) {}

    public function getNumPixels(): int
    {
        return $this->width * $this->height;
    }

    public function getAspectRatio(): float
    {
        return $this->width / $this->height;
    }

    protected function getObjectProperties(): array
    {
        return [
            'og:image' => $this->url,
            'og:image:type' => $this->type,
            'og:image:alt' => $this->alt,
            'og:image:width' => $this->width,
            'og:image:height' => $this->height
        ];
    }
}
