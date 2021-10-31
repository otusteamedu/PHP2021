<?php

namespace App\Classes\Exceptions;


class SocketBindingErrorException extends AppException
{
    public const ERROR_MESSAGE = 'Socket binding error';
    public const ERROR_CODE = 1003;
}
