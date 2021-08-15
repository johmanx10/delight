<?php

declare(strict_types=1);

namespace Delight\Website;

interface ContextCompilerInterface
{
    public function compile(array $context): array;
}
