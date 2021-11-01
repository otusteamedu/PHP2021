<?php

namespace App\Classes\Exceptions;


class TerminatedException extends AppException
{
    public const ERROR_MESSAGE = 'Terminated';
    public const ERROR_CODE = 1007;
}
