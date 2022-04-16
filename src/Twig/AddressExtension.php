<?php

declare(strict_types=1);

namespace Delight\Website\Twig;

use Delight\Website\Map\Address;
use Delight\Website\Map\CoordinateLookupInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AddressExtension extends AbstractExtension
{
    public function __construct(
        private CoordinateLookupInterface $coordinateLookup
    ) {}

    public function getFilters(): array
    {
        return [
            new TwigFilter('mapLink', $this->createMapLink(...))
        ];
    }

    public function createMapLink(Address $address): string
    {
        $coordinates = $this->coordinateLookup->lookup(
            sprintf(
                '%s %s %s',
                $address->street,
                $address->number,
                $address->locality
            )
        );

        // https://www.google.nl/maps/place/Fonteinland+7,+8913+CZ+Leeuwarden/@53.1997345,5.7817284/

        return sprintf(
            'https://www.google.nl/maps/place/%s/@%.7f,%.7f/',
            urlencode(
                sprintf(
                    '%s %s, %s %s',
                    $address->street,
                    $address->number,
                    $address->postalCode,
                    $address->locality
                )
            ),
            $coordinates->latitude,
            $coordinates->longitude
        );
    }
}
