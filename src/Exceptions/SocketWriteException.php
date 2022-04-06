<?php
namespace Ivanboriev\SocketChat\Exceptions;


class SocketWriteException extends \Exception
{
    protected $message = "Невозможно записать в сокет";
}