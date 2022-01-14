<?php

declare(strict_types=1);

use Delight\Website\OpenGraph\ImageAspectRatioValidator;
use Delight\Website\OpenGraph\ImageDimensionsValidator;
use Delight\Website\OpenGraph\ImageValidatorChain;

return new ImageValidatorChain(
    new ImageDimensionsValidator(200, 200),
    new ImageAspectRatioValidator(1.91)
);
