<?php

declare(strict_types=1);

namespace Delight\Website\Twig;

use DateTimeImmutable;
use DateTimeInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class DateExtension extends AbstractExtension
{
    private const DEFAULT_AGE_FORMAT = '%y';

    public function __construct(
        public readonly string $defaultAgeFormat = self::DEFAULT_AGE_FORMAT,
        public readonly DateTimeInterface $relativeDateTime = new DateTimeImmutable()
    ) {}

    public function getFilters(): array
    {
        return [
            new TwigFilter('age', $this->formatAge(...))
        ];
    }

    public function formatAge(
        DateTimeInterface|string $date,
        string $format = null,
        DateTimeInterface $relativeDateTime = null
    ): string {
        $format ??= $this->defaultAgeFormat;
        $relativeDateTime ??= $this->relativeDateTime;

        if (is_string($date)) {
            $date = new DateTimeImmutable($date);
        }

        return $date->diff($relativeDateTime)->format($format);
    }
}
