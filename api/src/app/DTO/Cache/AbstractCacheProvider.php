<?php

namespace App\DTO\Cache;

abstract class AbstractCacheProvider
{
    abstract public function serialize(): string;

    abstract public static function deserialize(string $data): object;
}
