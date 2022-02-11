<?php

declare(strict_types=1);

namespace Delight\Website\Twig;

use Measurements\Measurement;
use Measurements\Units\UnitDuration;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ProductExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('duration', self::formatDuration(...))
        ];
    }

    private static function formatDuration(Measurement $duration): string
    {
        return sprintf(
            '%d %s',
            $duration->value(),
            match ($duration->unit()->symbol()) {
                UnitDuration::SYMBOL_HOURS => 'uur',
                UnitDuration::SYMBOL_MINUTES => 'minuten',
                UnitDuration::SYMBOL_SECONDS => 'seconden'
            }
        );
    }
}
