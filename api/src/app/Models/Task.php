<?php

namespace App\Models;

use App\Traits\HasAuthor;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
