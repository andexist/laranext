<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class InvalidArgumentException extends \Exception
{
    public function __construct(private string $type, $message = "", $code = Response::HTTP_BAD_REQUEST, $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
