<?php

namespace App\Exceptions\Task;

use App\Exceptions\InvalidArgumentException;

class TaskExporterDTOException extends InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct(
            'TaskExporterDTOException',
            'Invalid instance provided. TaskExporterDTO expected.',
        );
    }    
}
