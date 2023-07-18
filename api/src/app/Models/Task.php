<?php

namespace App\Models;

use App\Collections\Task\TaskCollection;
use App\Traits\HasAuthor;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Task extends Model
{
    use HasFactory, HasAuthor, ModelHelpers;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'body',
        'time_estimated',
        'time_spent',
        'author_id',
    ];

    public function id(): string
    {
        return (string)$this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function timeEstimated(): int
    {
        return $this->time_estimated ?? 0;
    }

    public function timeSpent(): int
    {
        return $this->time_spent ?? 0;
    }

    public function createdAt(): string
    {
        return $this->created_at;
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array<int, \Illuminate\Database\Eloquent\Model>  $models
     * @return \Illuminate\Database\Eloquent\Collection<int, \Illuminate\Database\Eloquent\Model>
     */
    public function newCollection(array $models = []): Collection
    {
        return new TaskCollection($models);
    }
}
