<?php

namespace App\Classes\Exceptions;


class FileParsingErrorException extends AppException
{
    public const ERROR_MESSAGE = 'File parsing error';
    public const ERROR_CODE = 1001;
}
