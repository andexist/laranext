<?php

namespace App\Entities\Task;

class TaskEntity
{
    private string $uniqid;
    private string $title;
    private string $body;
    private int $time_estimated;
    private int $time_spent;
    private string $created_at;

    public function getUniqid(): string
    {
        return $this->uniqid;
    }

    public function setUniqid(int $uniqId)
    {
        $this->uniqid = (string)$uniqId;
    }

    public function getTitle(): string
    {
       return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function getTimeEstimated(): int
    {
        return $this->time_estimated;
    }


    public function setTimeEstimated(int $timeEstimated)
    {
        $this->time_estimated = $timeEstimated;
    }

    public function getTimeSpent(): int
    {
        return $this->time_spent;
    }

    public function setTimeSpent(int $timeSpent)
    {
        $this->time_spent = $timeSpent;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $createdAt)
    {
        $this->created_at = $createdAt;
    }
}
