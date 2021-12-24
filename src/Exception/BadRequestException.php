<?php

namespace App\Exception;

use Exception;

class BadRequestException extends Exception
{
    public const EMPTY = 'String not defined';
    public const INCORRECT = 'Incorrect string';

    public function __construct(string $message)
    {
        parent::__construct($message, 400);
    }
}
