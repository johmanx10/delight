<?php

declare(strict_types=1);

namespace Delight\Website\PositionStack;

interface LookupInterface
{
    public function forward(string $query): array;
}
