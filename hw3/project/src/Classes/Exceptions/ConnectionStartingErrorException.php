<?php

namespace App\Classes\Exceptions;


class ConnectionStartingErrorException extends AppException
{
    public const ERROR_MESSAGE = 'Connection starting error';
    public const ERROR_CODE = 1005;
}
