<?php

namespace App\Classes\Exceptions;


class FileNotReadableException extends AppException
{
    public const ERROR_MESSAGE = 'File is not readable';
    public const ERROR_CODE = 1000;
}
