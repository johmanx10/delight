<?php

declare(strict_types=1);

namespace Delight\Website\OpenGraph;

class ImageTypeValidator implements ImageValidatorInterface
{
    private array $types;

    public function __construct(string ...$types)
    {
        $this->types = $types;
    }

    public function validate(Image $image): ?ImageException
    {
        $result = null;

        if (!self::matches($image->type, ...$this->types)) {
            $result = new ImageException(
                sprintf(
                    'Image type must match one of: %s',
                    implode(', ', $this->types)
                ),
                $image
            );
        }

        return $result;
    }

    private static function matches(string $needle, string ...$patterns): bool
    {
        return array_reduce(
            $patterns,
            fn (bool $carry, string $pattern) => (
                $carry || fnmatch($pattern, $needle, FNM_PATHNAME)
            ),
            false
        );
    }
}
