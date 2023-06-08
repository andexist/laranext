<?php

namespace App\Collections\Task;

use Illuminate\Database\Eloquent\Collection;

class TaskCollection extends Collection
{
    public function toExportableFields(): self
    {
        $tasks = $this->setVisible([
            'title',
            'body',
            'time_estimated',
            'time_spent'
        ]);

        return $tasks->map(function($item) {
            $item->time_estimated = (string)$item->time_estimated;
            $item->time_spent = (string)$item->time_spent;

            return $item;
        });
    }
}
