<?php

namespace App\Service;

use Exception;

class ValidatorException extends Exception
{
    public const EMPTY = 'String not defined';
    public const INCORRECT = 'Incorrect string';
}
