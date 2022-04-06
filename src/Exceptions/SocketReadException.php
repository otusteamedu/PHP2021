<?php
namespace Ivanboriev\SocketChat\Exceptions;


class SocketReadException extends \Exception
{
    protected $message = "Невозможно прочитать сокет";
}