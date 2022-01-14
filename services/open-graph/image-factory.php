<?php

declare(strict_types=1);

use Delight\Website\OpenGraph\ImageFactory;
use Delight\Website\OpenGraph\ImageTypeValidator;

return new ImageFactory(
    WEB_ROOT,
    WEBSITE,
    new ImageTypeValidator('image/*')
);
