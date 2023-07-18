<?php

namespace App\Repositories\Elasticsearch\Interfaces;

use App\Entities\Task\TaskEntity;

interface AbstractElasticsearchRepositoryInterface
{
    /**
     * @return TaskEntity[]
     */
    public function search(int $userId, string $query): array;
    public function createOrUpdate(int $userId, object $data): void;
    public function delete(int $userId, object $data): void;
    public function deleteAllByIndex(int $userId): void;
}
