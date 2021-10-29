<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

interface ImageValidatorInterface
{
    public function validate(Image $image): ?ImageException;
}
