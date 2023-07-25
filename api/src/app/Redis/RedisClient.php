<?php

namespace App\Redis;

use Predis\Client;

class RedisClient implements RedisClientInterface
{
    private Client $client;

    public function __construct(string $host, int $port)
    {
        $this->client = new Client([
            'host' => $host,
            'port' => $port
        ]);
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
