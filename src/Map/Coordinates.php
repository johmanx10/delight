<?php

declare(strict_types=1);

namespace Delight\Website\Map;

final class Coordinates
{
    public function __construct(
        public readonly float $latitude,
        public readonly float $longitude
    ) {}
}
