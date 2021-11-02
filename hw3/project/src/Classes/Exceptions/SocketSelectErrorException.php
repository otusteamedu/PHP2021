<?php

namespace App\Classes\Exceptions;


class SocketSelectErrorException extends AppException
{
    public const ERROR_MESSAGE = 'Socket select error';
    public const ERROR_CODE = 1009;
}
