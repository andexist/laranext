<?php

namespace App\Services\Task;

use App\Models\Task;
use App\Repositories\Task\Interfaces\TaskRepositoryInterface;

class TaskService
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {}

    public function createOrUpdate(Task $task)
    {
        $this->taskRepository->save($task);
    }

    public function delete(Task $task)
    {
        $this->taskRepository->delete($task);
    }
}
