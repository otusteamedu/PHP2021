<?php
namespace Ivanboriev\SocketChat\Exceptions;

class ErrorStartingServerException extends \Exception
{
    protected $message = "Ошибка при запуске сервера";
}