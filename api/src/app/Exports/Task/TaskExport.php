<?php

namespace App\Exports\Task;

use App\Collections\Task\TaskCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TaskExport implements FromCollection, WithHeadings
{
    use Exportable, RegistersEventListeners;

    public function __construct(private TaskCollection $taskCollection)
    {}

    public function collection(): TaskCollection
    {
        return $this->taskCollection->toExportableFields();
    }

    public function headings(): array
    {
        return [
            'Title',
            'Body',
            'Time Estimated',
            'Time Spent',
        ];
    }
}
