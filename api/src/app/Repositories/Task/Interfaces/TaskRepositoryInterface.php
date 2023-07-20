<?php

namespace App\Repositories\Task\Interfaces;

use App\Collections\Task\TaskCollection;
use App\Models\Task;
use App\Repositories\AbstractRepositoryInterface;

interface TaskRepositoryInterface extends AbstractRepositoryInterface
{
    public function findById(int $id): Task;
    public function findAll(): TaskCollection;
    public function findByAuthor(int $authorId): TaskCollection;
    public function findByAuthorAndDate(int $authorId, string $from, string $to): TaskCollection;
    public function save(Task $task);
    public function delete(Task $task);
}
