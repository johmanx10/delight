<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

interface ImageFilterInterface
{
    public function filterImages(array $context, Image ...$images): array;
}
