<?php

declare(strict_types=1);

namespace Delight\Website\PositionStack;

use Delight\Website\OpenStreetMap\Coordinates;
use Delight\Website\OpenStreetMap\CoordinateLookupInterface;

class CoordinateLookup implements CoordinateLookupInterface
{
    public function __construct(
        private LookupInterface $addressLookup
    ) {}

    public function lookup(string $query): ?Coordinates
    {
        return array_reduce(
            $this->addressLookup->forward($query),
            self::reduceAddress(...)
        );
    }

    private static function reduceAddress(
        ?Coordinates $coordinate,
        array $address
    ): ?Coordinates {
        if ($coordinate === null
            && !empty($address['latitude'])
            && !empty($address['longitude'])
        ) {
            $coordinate = new Coordinates(
                latitude: $address['latitude'],
                longitude: $address['longitude']
            );
        }

        return $coordinate;
    }
}
