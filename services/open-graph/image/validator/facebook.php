<?php

declare(strict_types=1);

use Delight\Website\OpenGraph\ImageSizeValidator;
use Delight\Website\OpenGraph\ImageTypeValidator;
use Delight\Website\OpenGraph\ImageValidatorChain;

return new ImageValidatorChain(
    new ImageTypeValidator('image/*'),
    require __DIR__ . '/facebook/dimensions.php',
    new ImageSizeValidator(8 * 1024 ** 2)
);
