<?php

declare(strict_types=1);

namespace Delight\Website\Map;

interface CoordinateLookupInterface
{
    public function lookup(string $query): ?Coordinates;
}
