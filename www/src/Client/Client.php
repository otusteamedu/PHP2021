<?php
namespace Src\Client;

class Client
{

    private $socket;

    public function run()
    {
        if (!file_exists(SOCKET_PATH . '.sock')) {
            throw new \Exception('Сокет не существует');
        }
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        socket_connect($this->socket, SOCKET_PATH . '.sock');

        do {
            $output = readline('');
            socket_write($this->socket, $output);
            $input = socket_read($this->socket, 1024);
            echo $input;
        } while ($input != 'exit' && $input);

    }
}