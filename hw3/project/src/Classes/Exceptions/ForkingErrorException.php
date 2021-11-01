<?php

namespace App\Classes\Exceptions;


class ForkingErrorException extends AppException
{
    public const ERROR_MESSAGE = 'Cannot fork the process';
    public const ERROR_CODE = 1006;
}
