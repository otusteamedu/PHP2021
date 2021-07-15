<?php

namespace App\Exception;

use Exception;
use Throwable;

class InvalidStringException extends Exception
{
    public function __construct($code = 0, Throwable $previous = null)
    {
        header("HTTP/1.1 400 Bad Request");
        parent::__construct('invalid string', $code, $previous);
    }
}