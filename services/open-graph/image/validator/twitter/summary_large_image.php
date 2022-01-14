<?php

declare(strict_types=1);

use Delight\Website\OpenGraph\ImageSizeValidator;
use Delight\Website\OpenGraph\ImageTypeValidator;
use Delight\Website\OpenGraph\ImageValidatorChain;

return new ImageValidatorChain(
    new ImageTypeValidator('image/png', 'image/webp', 'image/jpeg', 'image/gif'),
    require __DIR__ . '/summary_large_image/dimensions.php',
    new ImageSizeValidator(5 * 1024 ** 2)
);
