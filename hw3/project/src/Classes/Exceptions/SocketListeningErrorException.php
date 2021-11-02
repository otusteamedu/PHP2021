<?php

namespace App\Classes\Exceptions;


class SocketListeningErrorException extends AppException
{
    public const ERROR_MESSAGE = 'Socket listening error';
    public const ERROR_CODE = 1004;
}
