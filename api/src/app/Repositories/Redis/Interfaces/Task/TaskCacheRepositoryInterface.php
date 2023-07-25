<?php

namespace App\Repositories\Redis\Interfaces\Task;

use App\DTO\Cache\Task\TaskCacheDTO;

interface TaskCacheRepositoryInterface
{
    public function findById(int $id): TaskCacheDTO;
    public function findAll();
}
