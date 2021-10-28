<?php

declare(strict_types=1);

namespace Delight\Website\SRI;

use SplFileInfo;
use Stringable;

final class SubResource implements Stringable
{
    /** @todo Turn into Enum in PHP 8.1 */
    public const ALGO_SHA256 = 'sha256';
    public const ALGO_SHA384 = 'sha384';
    public const ALGO_SHA512 = 'sha512';

    private string $hash;

    public function __construct(
        private string $algo,
        private SplFileInfo $resource
    ) {}

    public function getHash(): string
    {
        return $this->hash ??= self::calculateHash($this->algo, $this->resource);
    }

    public function getHashAsString(): string
    {
        return bin2hex($this->getHash());
    }

    private static function calculateHash(string $algo, SplFileInfo $resource): string
    {
        return hash($algo, file_get_contents($resource->getPathname()), true);
    }

    public function __toString(): string
    {
        return sprintf(
            '%s-%s',
            $this->algo,
            base64_encode($this->getHash())
        );
    }
}
