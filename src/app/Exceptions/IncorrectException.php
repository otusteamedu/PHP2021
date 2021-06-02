<?php

namespace App\Exceptions;

use Exception;

class IncorrectException extends Exception
{
    public function __construct(\Throwable $previous = null)
    {
        http_response_code(400);
        parent::__construct('Incorrect', 0, $previous);
    }
}
