<?php

declare(strict_types=1);

namespace Delight\Website\Context;

use Delight\Website\ContextCompilerInterface;
use Measurements\Measurement;
use Measurements\Quantities\Duration;
use Measurements\Units\UnitDuration;

class DurationCompiler implements ContextCompilerInterface
{
    public function __construct(private UnitDuration $unit) {}

    public function compile(array $context): array
    {
        $context['duration'] = is_array($context['duration'])
            ? $this->compileRange($context['duration'])
            : $this->compileDuration($context['duration']);

        return $context;
    }

    private function compileDuration(string $duration): Measurement
    {
        [$hours, $minutes, $seconds] = explode(
            ':',
            sprintf('%s:00:00', $duration),
            4
        );

        return Duration::seconds((int)ltrim($seconds, '0'))
            ->add(Duration::minutes((int)ltrim($minutes, '0')))
            ->add(Duration::hours((int)ltrim($hours, '0')))
            ->convertTo($this->unit);
    }

    private function compileRange(array $duration): array
    {
        [$start, $end] = $duration;

        return [
            $this->compileDuration($start),
            $this->compileDuration($end)
        ];
    }
}
