<?php

declare(strict_types=1);

namespace Delight\Website\SRI;

use SplFileInfo;
use Stringable;

final class SubResource implements Stringable
{
    /** @todo Turn into Enum in PHP 8.1 */
    private const ALGO_SHA256 = 'sha256';
    private const ALGO_SHA384 = 'sha384';
    private const ALGO_SHA512 = 'sha512';

    private string $hash;

    private function __construct(
        private string $algo,
        private SplFileInfo $resource
    ) {}

    public function getHash(): string
    {
        return $this->hash ??= self::calculateHash($this->algo, $this->resource);
    }

    private static function calculateHash(string $algo, SplFileInfo $resource): string
    {
        return hash($algo, file_get_contents($resource->getRealPath()), true);
    }

    public function __toString(): string
    {
        return sprintf(
            '%s-%s',
            $this->algo,
            base64_encode($this->getHash())
        );
    }

    public static function sha256(string $resource): self
    {
        return new self(
            self::ALGO_SHA256,
            new SplFileInfo($resource)
        );
    }

    public static function sha384(string $resource): self
    {
        return new self(
            self::ALGO_SHA384,
            new SplFileInfo($resource)
        );
    }

    public static function sha512(string $resource): self
    {
        return new self(
            self::ALGO_SHA512,
            new SplFileInfo($resource)
        );
    }
}
