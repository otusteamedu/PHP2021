<?php

namespace App\Exceptions;

use Exception;

class EmptyDataException extends Exception
{
    public function __construct(\Throwable $previous = null)
    {
        http_response_code(400);
        parent::__construct('Empty data', 0, $previous);
    }
}
