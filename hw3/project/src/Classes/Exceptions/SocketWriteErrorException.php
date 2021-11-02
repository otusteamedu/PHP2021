<?php

namespace App\Classes\Exceptions;


class SocketWriteErrorException extends AppException
{
    public const ERROR_MESSAGE = 'Socket write error';
    public const ERROR_CODE = 1010;
}
