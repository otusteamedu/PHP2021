<?php

namespace App\Classes\Exceptions;


class StreamSelectErrorException extends AppException
{
    public const ERROR_MESSAGE = 'Stream select error';
    public const ERROR_CODE = 1008;
}
