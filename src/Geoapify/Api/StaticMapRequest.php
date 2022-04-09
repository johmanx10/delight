<?php

declare(strict_types=1);

namespace Delight\Website\Geoapify\Api;

use Delight\Website\Geoapify\ImageFormat;
use Delight\Website\Geoapify\MapSize;
use Delight\Website\Geoapify\MapStyle;
use Delight\Website\Geoapify\Marker;
use Delight\Website\OpenStreetMap\Coordinates;

final class StaticMapRequest
{
    /** @var Marker[] */
    private array $markers = [];

    public function __construct(
        public readonly Coordinates $center,
        public readonly float $zoomLevel = 17.,
        public readonly MapSize $size = new MapSize(),
        public readonly MapStyle $style = MapStyle::TONER_GREY,
        public readonly ImageFormat $imageFormat = ImageFormat::JPEG
    ) {}

    public function addMarker(Marker $marker): void
    {
        $this->markers[] = $marker;
    }

    /**
     * @return Marker[]
     */
    public function getMarkers(): array
    {
        return $this->markers;
    }
}
