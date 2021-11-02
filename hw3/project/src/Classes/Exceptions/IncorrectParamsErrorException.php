<?php

namespace App\Classes\Exceptions;


class IncorrectParamsErrorException extends AppException
{
    public const ERROR_MESSAGE = 'Incorrect params';
    public const ERROR_CODE = 1002;
}
