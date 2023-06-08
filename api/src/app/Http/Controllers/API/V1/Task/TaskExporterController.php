<?php

namespace App\Http\Controllers\API\V1\Task;

use App\DTO\DataExporter\Task\TaskExporterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Task\ExportTaskRequest;
use App\Services\DataExporter\Task\TaskExporterService;

class TaskExporterController extends Controller
{
    public function __construct(private TaskExporterService $taskExporterService)
    {}

    public function exportToCSV(ExportTaskRequest $request)
    {
        return $this->taskExporterService->exportToCSV(
            new TaskExporterDTO($request->from(), $request->to(), auth()->user()->id)
        );
    }

    public function exportToXLSX(ExportTaskRequest $request)
    {
         return $this->taskExporterService->exportToXLSX(
            new TaskExporterDTO($request->from(), $request->to(), auth()->user()->id)
        );
    }

    public function exportToPDF(ExportTaskRequest $request)
    {
        return $this->taskExporterService->exportToPDF(
            new TaskExporterDTO($request->from(), $request->to(), auth()->user()->id)
        );
    }
}
