<?php
namespace Src;

class App {

    CONST socket = 5346;

    public function run()
    {
//        var_dump(getopt('f:')['f']);
        if (getopt('f:')['f'] == 'server') {
            $socket = socket_create(AF_UNIX, SOCK_STREAM, 0);//создаём сокет
            try {
                socket_bind($socket, '/tmp/socket' . $this::socket . '.sock', 20);
            } catch (\Exception $exception) {
                var_dump($exception);
            }
            $result = socket_listen($socket);
            $connection = socket_accept($socket);
            // Поток вывода меняется на консоль
            do {
                $message = socket_read($connection, 1024);
//                socket_write($socket, 'sdfsdf');
                echo $message;
            } while (true);
        } else {
            $socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

            $connection = socket_connect($socket, '/tmp/socket' . $this::socket . '.sock');
            socket_write($socket, 'hello');

            do {
                $a = readline('');
                socket_write($socket, $a);
//                $warn = socket_read($socket, 1024);
//                echo 123;
            } while (true);

//            while($read = socket_read($socket, 1024))
//            {
//                echo 123;
//                socket_write($socket, "dsd");
//            }
//            socket_close($socket);

//            echo "Полученный результат:  $result\r\n";
        }

    }
}