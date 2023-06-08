<?php

namespace App\Services\DataExporter;

use App\DTO\DataExporter\AbstractDataExporterDTO;
use App\Repositories\AbstractRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel as Format;

abstract class AbstractDataExporter
{
    const FILE_FORMATS = [
        'csv' => Format::CSV,
        'xlsx' => Format::XLSX,
        'dompdf' => Format::DOMPDF,
    ];

    public function __construct(private AbstractRepositoryInterface $repository)
    {}

    abstract function exportToCSV(AbstractDataExporterDTO $dataExporterDTO);

    abstract function exportToXLSX(AbstractDataExporterDTO $dataExporterDTO);

    abstract function exportToPDF(AbstractDataExporterDTO $dataExporterDTO);

    protected function filename(string $table, string $extension): string
    {
        return $table . '-' . Carbon::now()->timestamp . '.' . $extension;
    }

    protected function prepareTableForPDFExport(Collection $collection): string
    {
        $array = $collection->toArray();

        $tableField = '<tr>';

        foreach(array_keys($array[0]) as $field) {
            $tableField .= '<th style="background-color: #1b4965; color: #fff">' . Str::snakeToTitle($field) . '</th>';
        }

        $tableField .= '</tr>';

        $table = '<table>';
        $table .= $tableField;
        $index = 1;

        foreach ($array as $row) {
            if ($index % 2 === 0) {
                $table .= '<tr style="background-color: #edf2f4;">';
            } else {
                $table .= '<tr>';
            }
            
            foreach ($row as $value) {
                $table .= '<td>' . $value . '</td>';
            }
            $index++;
            $table .= '</tr>';
        }

        $table .= '</table>';

        return $table;
    }
}
