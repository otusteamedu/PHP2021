<?php

namespace App\Classes\Exceptions;


class AppException extends \Exception
{
    const ERROR_MESSAGE = 'Unknown error';
    const ERROR_CODE = 0;

    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message ?: static::ERROR_MESSAGE, $code ?: static::ERROR_CODE, $previous);
    }
}
