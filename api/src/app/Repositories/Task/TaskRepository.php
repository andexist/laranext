<?php

namespace App\Repositories\Task;

use App\Collections\Task\TaskCollection;
use App\Models\Task;
use App\Repositories\Task\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function findById(int $id): Task
    {
        return Task::findOrFail($id);
    }

    public function findAll(): TaskCollection
    {
        return Task::all();
    }

    public function findByAuthor(int $authorId): TaskCollection
    {
        return Task::where('author_id', $authorId)->get();
    }

    public function findByAuthorAndDate(int $authorId, string $from, string $to): TaskCollection
    {
        return Task::where('author_id', $authorId)
            ->whereBetween('created_at', [$from, $to])
            ->get();
    }
}
