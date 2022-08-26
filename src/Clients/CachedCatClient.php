<?php

namespace App\Clients;

use App\Contracts\CatClientInterface;

class CachedCatClient implements CatClientInterface
{
    public const CACHE_TTL_SEC = 60 * 3;

    protected CatClientInterface $catClient;
    protected string $cacheDir;

    public function __construct(CatClientInterface $catClient)
    {
        $this->catClient = $catClient;

        $this->cacheDir = __DIR__ . '/../../cache';
        if (!file_exists($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    public function breeds(): array
    {
        $cachePath = $this->cacheDir . '/breeds.cache';
        if (is_file($cachePath) && time() - filemtime($cachePath) <= self::CACHE_TTL_SEC) {
            return unserialize(file_get_contents($cachePath));
        }

        $breeds = $this->catClient->breeds();
        file_put_contents($cachePath, serialize($breeds));

        return $breeds;
    }

    public function images(string $breedId, string $size = 'thumb'): array
    {
        $cachePath = $this->cacheDir . "/{$breedId}_{$size}.cache";
        if (is_file($cachePath) && time() - filemtime($cachePath) <= self::CACHE_TTL_SEC) {
            return unserialize(file_get_contents($cachePath));
        }

        $images = $this->catClient->images($breedId, $size);
        file_put_contents($cachePath, serialize($images));

        return $images;
    }
}
