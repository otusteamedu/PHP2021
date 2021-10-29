<?php
namespace Src;

class App {

    public function run()
    {
        $socket = socket_create(AF_UNIX, SOCK_STREAM, 0);//создаём сокет
        try {
            socket_bind($socket, '/tmp/socket' . rand() . '.sock');
        } catch (\Exception $exception) {
            var_dump($exception);
        }
        $result = socket_listen($socket);
        $connection = socket_accept($socket);
    }
}