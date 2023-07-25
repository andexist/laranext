<?php

namespace App\Repositories\Redis;

use App\Redis\RedisClientInterface;
use App\Repositories\Redis\Interfaces\AbstractCacheRepositoryInterface;

abstract class AbstractCacheRepository implements AbstractCacheRepositoryInterface
{
    public function __construct(private RedisClientInterface $redis)
    {}

    abstract protected function key(int $uniqid): string;

    public function set(int $uniqid, string $data)
    {
        $this->redis->getClient()->set(
            $this->key($uniqid),
            $data
        );
    }

    public function get(int $uniqId): string
    {
        return $this->redis->getClient()->get(
            $this->key($uniqId)
        );
    }
}
