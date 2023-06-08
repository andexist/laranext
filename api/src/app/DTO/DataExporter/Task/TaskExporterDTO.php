<?php

namespace App\DTO\DataExporter\Task;

use App\DTO\DataExporter\AbstractDataExporterDTO;

class TaskExporterDTO extends AbstractDataExporterDTO
{
    public function __construct(
        protected string $from, 
        protected string $to,
        private int $authorId 
    ) 
    {
        parent::__construct($from, $to);
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }
}
