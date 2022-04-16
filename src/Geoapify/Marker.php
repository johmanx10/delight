<?php

declare(strict_types=1);

namespace Delight\Website\Geoapify;

use Delight\Website\Map\Coordinates;

final class Marker
{
    public function __construct(
        public readonly Coordinates $center,
        public readonly string $color,
        public readonly IconSize $iconSize = IconSize::MEDIUM
    ) {}
}
