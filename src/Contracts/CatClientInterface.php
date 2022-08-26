<?php

namespace App\Contracts;

interface CatClientInterface
{
    public function breeds(): array;
    public function images(string $breedId, string $size = 'thumb'): array;
}
