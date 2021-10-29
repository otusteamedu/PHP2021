<?php
namespace Src;

class App {

    CONST socket = 555;

    public function run()
    {
//        var_dump(getopt('f:')['f']);
        if (getopt('f:')['f'] == 'server') {
            $socket = socket_create(AF_UNIX, SOCK_STREAM, 0);//создаём сокет
            try {
                socket_bind($socket, '/tmp/socket' . $this::socket . '.sock');
            } catch (\Exception $exception) {
                var_dump($exception);
            }
            $result = socket_listen($socket);
            $connection = socket_accept($socket);
            do {
                $message = socket_read($connection, 1024);
                echo $message;
            } while ($message != 'выход');
        }

    }
}