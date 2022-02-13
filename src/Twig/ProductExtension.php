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

    private static function formatDuration(
        Measurement $duration,
        bool $unit = true
    ): string {
        $value = $duration->value();
        $decimals = 0;

        if ((float)(int)$value !== (float)$value) {
            $decimals = 1;
        }

        $result = number_format($duration->value(), $decimals, ',', '.');

        return $unit
            ? sprintf(
                '%s %s',
                $result,
                match ($duration->unit()->symbol()) {
                    UnitDuration::SYMBOL_HOURS => 'uur',
                    UnitDuration::SYMBOL_MINUTES => 'minuten',
                    UnitDuration::SYMBOL_SECONDS => 'seconden'
                }
            )
            : $result;
    }
}
