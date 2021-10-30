<?php
namespace Src\Client;

class Client
{
    const SOCKET_NAME = '555';
    const SOCKET_DIR = '/tmp';
    private $socket;

    public function run()
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        socket_connect($this->socket, $this::SOCKET_DIR . '/' . $this::SOCKET_NAME . '.sock');

        do {
            $output = readline('');
            socket_write($this->socket, $output);
            $input = socket_read($this->socket, 1024);
            echo $input;
        } while ($input != 'exit');

    }
}