<?php

namespace App\Services\DataExporter\Task;

use App\DTO\DataExporter\AbstractDataExporterDTO;
use App\DTO\DataExporter\Task\TaskExporterDTO;
use App\Exceptions\Task\TaskExporterDTOException;
use App\Exports\Task\TaskExport;
use App\Repositories\Task\Interfaces\TaskRepositoryInterface;
use App\Services\DataExporter\AbstractDataExporter;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;

class TaskExporterService extends AbstractDataExporter
{
    private static $table = 'tasks';

    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
        parent::__construct($taskRepository);
    }

    public function exportToCSV(AbstractDataExporterDTO $taskExporterDTO)
    {
        if (!($taskExporterDTO instanceof TaskExporterDTO)) {
            throw new TaskExporterDTOException();
        }

        return Excel::download(
            new TaskExport($this->tasks($taskExporterDTO)),
            $this->filename(self::$table, strtolower(self::FILE_FORMATS['csv'])),
            self::FILE_FORMATS['csv'],
            ['Content-Type' => 'text/csv']
        );
    }

    public function exportToXLSX(AbstractDataExporterDTO $taskExporterDTO)
    {
        if (!($taskExporterDTO instanceof TaskExporterDTO)) {
            throw new TaskExporterDTOException();
        }
        
        return Excel::download(
            new TaskExport($this->tasks($taskExporterDTO)),
            $this->filename(self::$table, strtolower(self::FILE_FORMATS['xlsx'])),
            self::FILE_FORMATS['xlsx'],
        );
    }

    public function exportToPDF(AbstractDataExporterDTO $taskExporterDTO)
    {
        if (!($taskExporterDTO instanceof TaskExporterDTO)) {
            throw new TaskExporterDTOException();
        }

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml(
            $this->prepareTableForPDFExport(
                $this->tasks($taskExporterDTO)->toExportableFields()
            )
        );
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream($this->filename(self::$table, 'pdf'));
    }

    private function tasks(TaskExporterDTO $dto)
    {
        $from = Carbon::parse($dto->getFrom());
        $to = Carbon::parse($dto->getTo());

        return $this->taskRepository->findByAuthorAndDate($dto->getAuthorId(), $from, $to);
    }
}
