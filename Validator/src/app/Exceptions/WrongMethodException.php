<?php

namespace App\Exceptions;

use Exception;

class WrongMethodException extends Exception
{
    public function __construct(\Throwable $previous = null)
    {
        http_response_code(400);
        parent::__construct('Wrong method', 0, $previous);
    }
}
