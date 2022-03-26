<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

class ImageAspectRatioValidator implements ImageValidatorInterface
{
    private float $minimum;
    private float $maximum;

    public function __construct(
        private float $aspectRatio,
        private float $tolerance = .55,
        private int $precision = 2
    ) {}

    public function validate(Image $image): ?ImageException
    {
        $result = null;
        $ratio = $image->getAspectRatio();

        if ($ratio < $this->getMinimum() || $ratio > $this->getMaximum()) {
            $result = new ImageException(
                sprintf(
                    "Image aspect ratio is targeted at %.{$this->precision}f:1"
                    . " and must be between %.{$this->precision}f:1"
                    . " and %.{$this->precision}f:1.",
                    $this->aspectRatio,
                    $this->getMinimum(),
                    $this->getMaximum()
                ),
                $image
            );
        }

        return $result;
    }

    private function getMinimum(): float
    {
        return $this->minimum ??= round(
            num: $this->aspectRatio - $this->tolerance,
            precision: $this->precision,
            mode: PHP_ROUND_HALF_DOWN
        );
    }

    private function getMaximum(): float
    {
        return $this->maximum ??= round(
            num: $this->aspectRatio + $this->tolerance,
            precision: $this->precision,
            mode: PHP_ROUND_HALF_UP
        );
    }
}
