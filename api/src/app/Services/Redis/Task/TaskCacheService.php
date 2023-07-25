<?php

namespace App\Services\Redis\Task;

use App\DTO\Cache\Task\TaskCacheDTO;
use App\Repositories\Redis\Task\TaskCacheRepository;

class TaskCacheService
{
    public function __construct(private TaskCacheRepository $taskCacheRepository)
    {}

    public function set(int $unniqid, TaskCacheDTO $taskCacheDTO)
    {
        $this->taskCacheRepository->set($unniqid, $taskCacheDTO->serialize());
    }

    public function get(int $uniqid)
    {
        return $this->taskCacheRepository->findById($uniqid);
    }
}
