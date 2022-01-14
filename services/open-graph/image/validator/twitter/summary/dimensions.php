<?php

declare(strict_types=1);

use Delight\Website\OpenGraph\ImageAspectRatioValidator;
use Delight\Website\OpenGraph\ImageDimensionsValidator;
use Delight\Website\OpenGraph\ImageValidatorChain;

return new ImageValidatorChain(
    new ImageDimensionsValidator(144, 144, 4096, 4096),
    new ImageAspectRatioValidator(1)
);
