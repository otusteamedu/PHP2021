<?php

namespace App\Exception;

use Exception;
use Throwable;

class InvalidMethodException extends Exception
{
    public function __construct($message,$code = 0, Throwable $previous = null)
    {
        header("HTTP/1.1 400 Bad Request");
        parent::__construct($message, $code, $previous);
    }
}