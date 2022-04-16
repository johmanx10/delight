<?php

declare(strict_types=1);

namespace Delight\Website\Map;

final class Address
{
    public function __construct(
        public readonly string $locality,
        public readonly string $postalCode,
        public readonly string $street,
        public readonly string $number,
        public readonly string $country
    ) {}
}
