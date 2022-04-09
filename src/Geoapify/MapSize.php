<?php

declare(strict_types=1);

namespace Delight\Website\Geoapify;

final class MapSize
{
    public function __construct(
        public readonly int $width = 1024,
        public readonly int $height = 768
    ) {}
}
