<?php

declare(strict_types=1);

namespace Delight\Website\PositionStack;

use DateInterval;
use Psr\Cache\CacheItemPoolInterface;

class CacheProxyLookup implements LookupInterface
{
    public const DEFAULT_TTL = 'P1Y';

    public function __construct(
        private LookupInterface $decorated,
        private CacheItemPoolInterface $cache,
        private DateInterval $ttl = new DateInterval(self::DEFAULT_TTL),
        private string $hashAlgo = 'sha1'
    ) {}

    private function normalizeKey(string $key): string
    {
        return hash($this->hashAlgo, $key);
    }

    public function forward(string $query): array
    {
        $key = $this->normalizeKey($query);

        $item = $this->cache->getItem($key);

        if (!$item->isHit()) {
            $item->set($this->decorated->forward($query));
            $item->expiresAfter($this->ttl);
            $this->cache->save($item);
        }

        return $item->get();
    }
}
