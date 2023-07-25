<?php

namespace App\Repositories\Redis\Interfaces;

interface AbstractCacheRepositoryInterface
{
    public function set(int $uniqid, string $data);
    public function get(int $uniqid): string;
}
