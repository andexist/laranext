<?php

namespace App\DTO\DataExporter;

abstract class AbstractDataExporterDTO
{
    public function __construct(
        protected string $from,
        protected string $to
    )
    {}
}
