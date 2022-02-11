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

        $context[self::KEY] = array_map(
            fn (array $diploma) => array_replace(
                $diploma,
                [
                    'thumbnail' => $this->compileThumbnail(
                        $diploma['thumbnail']
                    )
                ]
            ),
            $context[self::KEY]
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
        [$width, $height] = @getimagesize(
            rtrim($this->root, '/') . '/' . ltrim($path, '/')
        ) ?: [0, 0];

        return [
            'path' => $path,
            'width' => $width,
            'height' => $height
        ];
    }
}
