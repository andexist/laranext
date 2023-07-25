<?php

namespace App\Repositories\Redis\Task;
use App\DTO\Cache\Task\TaskCacheDTO;
use App\Models\Task;
use App\Redis\RedisClientInterface;
use App\Repositories\Redis\AbstractCacheRepository;
use App\Repositories\Redis\Interfaces\Task\TaskCacheRepositoryInterface;
use App\Repositories\Task\Interfaces\TaskRepositoryInterface;

class TaskCacheRepository extends AbstractCacheRepository implements TaskCacheRepositoryInterface
{
    public function __construct(
        private RedisClientInterface $redis,
        private TaskRepositoryInterface $taskRepository
    ) {
        parent::__construct($redis);
    }

    private static $cacheKey = 'task_%d';

    public function findById(int $id): TaskCacheDTO
    {
        $cacheKey = $this->key($id);

        $cachedData = $this->redis->getClient()->get($cacheKey);

        if (null === $cachedData) {
            $task = $this->taskRepository->findById($id);

            $taskCacheDTO = TaskCacheDTO::fromModel($task);

            $this->set($id, $taskCacheDTO->serialize());

            return $taskCacheDTO;
        }

        return TaskCacheDTO::deserialize($cachedData);
    }

    public function findAll()
    {

    }

    protected function key(int $uniqid): string
    {
        return sprintf(self::$cacheKey, $uniqid);
    }
}
