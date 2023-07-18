<?php

namespace App\Services\Elasticsearch\Task;

use App\Models\Task;
use App\Repositories\Elasticsearch\Task\TaskElasticsearchRepository;

class TaskElasticsearchService
{
    public function __construct(private TaskElasticsearchRepository $taskElasticsearchRepository)
    {}

    public function search(int $userId, string $query): array
    {
        return $this->taskElasticsearchRepository->search($userId, $query);
    }

    public function createOrUpdate(int $userId, Task $task): void
    {
        $this->taskElasticsearchRepository->createOrUpdate($userId, $task);
    }

    public function delete(int $userId, Task $task): void
    {
        $this->taskElasticsearchRepository->delete($userId, $task);
    }

    public function deleteAllByIndex(int $userId): void
    {
        $this->taskElasticsearchRepository->deleteAllByIndex($userId);
    }

    public function findAllByIndex(int $userId): array
    {
        return $this->taskElasticsearchRepository->findAllByIndex($userId);
    }
}
