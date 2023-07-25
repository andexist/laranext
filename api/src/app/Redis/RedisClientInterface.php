<?php

namespace App\Redis;

use Predis\Client;

interface RedisClientInterface
{
    public function getClient(): Client;
}
