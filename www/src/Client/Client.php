<?php
namespace Src\Client;

use Src\Exceptions\SocketException;
use Src\SocketServer;

class Client extends SocketServer
{
    protected function initializeConnection()
    {
        if (!file_exists(SOCKET_PATH . '.sock')) {
            throw new \Exception('Сокет не существует');
        }
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        socket_connect($this->socket, SOCKET_PATH . '.sock');
    }

    protected function acceptMessages()
    {
        do {
            $output = readline('');
            if (!socket_write($this->socket, $output)) {
                throw new SocketException();
            };
            $input = socket_read($this->socket, $this::INPUT_LENGTH);
            echo $input;
        } while ($input != 'exit' && $input);
    }

}