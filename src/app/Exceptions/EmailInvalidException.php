<?php

namespace App\Exceptions;

use Exception;

class EmailInvalidException extends Exception
{
    public function __construct(\Throwable $previous = null)
    {
        http_response_code(400);
        parent::__construct('Email is invalid', 0, $previous);
    }
}
