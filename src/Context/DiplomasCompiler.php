<?php

declare(strict_types=1);

namespace Delight\Website\Context;

use Delight\Website\ContextCompilerInterface;
use JetBrains\PhpStorm\ArrayShape;

class DiplomasCompiler implements ContextCompilerInterface
{
    private const KEY = 'diplomas';

    public function __construct(private string $root) {}

    public function compile(array $context): array
    {
        if (!array_key_exists(self::KEY, $context)) {
            return $context;
        }

        $context[self::KEY] = array_reduce(
            $context[self::KEY],
            function (array $carry, array $diploma): array {
                $thumbnail = @$this->compileThumbnail($diploma['thumbnail']);

                if (!empty($thumbnail['width']) && !empty($thumbnail['height'])) {
                    $carry[] = array_replace(
                        $diploma,
                        ['thumbnail' => $thumbnail]
                    );
                }

                return $carry;
            },
            []
        );

        return $context;
    }

    #[ArrayShape(
        [
            'path' => 'string',
            'width' => 'int',
            'height' => 'int'
        ]
    )]
    private function compileThumbnail(string $path): array
    {
        [$width, $height] = getimagesize(
            rtrim($this->root, '/') . '/' . ltrim($path, '/')
        );

        return [
            'path' => $path,
            'width' => $width,
            'height' => $height
        ];
    }
}
