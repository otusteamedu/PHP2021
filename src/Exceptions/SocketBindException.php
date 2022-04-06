<?php
namespace Ivanboriev\SocketChat\Exceptions;

class SocketBindException extends \Exception
{
    protected $message = "Не удалось установить соединение с сокетом";
}