<?php
namespace Ivanboriev\SocketChat\Exceptions;


class SocketListenException extends \Exception
{
    protected $message = "Невозможно прослушать сокет";
}