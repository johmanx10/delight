<?php

declare(strict_types=1);

namespace Delight\Website\Geoapify\Api;

use Delight\Website\Geoapify\Marker;
use Delight\Website\OpenStreetMap\Coordinates;

final class StaticMapFormatter
{
    public function __construct(
        private string $baseUri,
        private string $apiKey
    ) {}

    private static function createQuery(
        string $apiKey,
        StaticMapRequest $request
    ): array {
        return [
            'apiKey' => $apiKey,
            'style' => $request->style->value,
            'width' => $request->size->width,
            'height' => $request->size->height,
            'format' => $request->imageFormat->value,
            'center' => self::formatCoordinates($request->center),
            'zoom' => sprintf(
                '%.1f',
                $request->zoomLevel
            )
        ];
    }

    private static function formatCoordinates(Coordinates $coordinates): string
    {
        return sprintf(
            'lonlat:%.6f,%.6f',
            $coordinates->longitude,
            $coordinates->latitude
        );
    }

    private static function formatMarker(Marker $marker): string
    {
        return implode(
            ';',
            [
                self::formatCoordinates($marker->center),
                sprintf(
                    'color:%s',
                    str_replace('#', '%23', $marker->color)
                ),
                sprintf('size:%s', $marker->iconSize->value)
            ]
        );
    }

    public function formatUrl(StaticMapRequest $request): string
    {
        $query = http_build_query(self::createQuery($this->apiKey, $request));
        $markers = $request->getMarkers();

        if (count($markers) > 0) {
            $query = sprintf(
                '%s&marker=%s',
                $query,
                implode(
                    '|',
                    array_map(self::formatMarker(...), $markers)
                )
            );
        }

        return sprintf(
            '%s/staticmap?%s',
            rtrim($this->baseUri, '/'),
            $query
        );
    }
}
