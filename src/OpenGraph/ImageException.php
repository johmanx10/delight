<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

use RuntimeException;

final class ImageException extends RuntimeException
{
    public function __construct(string $message, public Image $image)
    {
        parent::__construct($message);
    }
}
