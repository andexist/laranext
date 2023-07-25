<?php

namespace App\DTO\Cache\Task;
use App\DTO\Cache\AbstractCacheProvider;
use App\Models\Task;

class TaskCacheDTO extends AbstractCacheProvider
{
    public function __construct(
        private int $id,
        private string $title,
        private string $body,
        private int $timeEstimated,
        private int $timeSpent,
        private int $authorId,
        private string $createdAt,
        private string $updatedAt
    )
    {}

    public function serialize(): string
    {
        return json_encode(
            [
                'id' => $this->id,
                'title' => $this->title,
                'body' => $this->body,
                'timeEstimated' => $this->timeEstimated,
                'timeSpent' => $this->timeSpent,
                'authorId' => $this->authorId,
                'createdAt' => $this->createdAt,
                'updatedAt' => $this->updatedAt,
            ]
        );
    }

    public static function deserialize(string $data): TaskCacheDTO
    {
        $data = json_decode($data, true);

        if (!$data) {
            // throw new exception
        }

        return new self(
            $data['id'],
            $data['title'],
            $data['body'],
            $data['timeEstimated'],
            $data['timeSpent'],
            $data['authorId'],
            $data['createdAt'],
            $data['updatedAt']
        );
    }

    public static function fromModel(Task $task): self
    {
        return new self(
            $task->id,
            $task->title,
            $task->body,
            $task->time_estimated,
            $task->time_spent,
            $task->author_id,
            $task->created_at,
            $task->updated_at
        );
    }
}
