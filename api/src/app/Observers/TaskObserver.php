<?php

namespace App\Observers;

use App\Models\Task;
use App\Services\Elasticsearch\Task\TaskElasticsearchService;

class TaskObserver
{
    public function __construct(private TaskElasticsearchService $taskElasticsearchService)
    {}

    public function created(Task $task)
    {
        $this->taskElasticsearchService->createOrUpdate(
            $task->author()->id,
            $task
        );
    }

    public function updated(Task $task)
    {
        $this->taskElasticsearchService->createOrUpdate(
            $task->author()->id,
            $task
        );
    }

    public function deleting(Task $task)
    {
        $this->taskElasticsearchService->delete(
            $task->author()->id,
            $task
        );
    }
}
