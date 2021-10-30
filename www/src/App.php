<?php
namespace Src;

class App {

    CONST socket = 123123;

    public function run()
    {
        $client_sockets = [];
        $abort = false;
        $NULL = null;
//        var_dump(getopt('f:')['f']);
        if (getopt('f:')['f'] == 'server') {
            $socket = socket_create(AF_UNIX, SOCK_STREAM, 0);//создаём сокет
            try {
                socket_bind($socket, '/tmp/socket' . $this::socket . '.sock', 20);
            } catch (\Exception $exception) {
                var_dump($exception);
            }
            socket_listen($socket);

            $read = [$socket];

//            while (!$abort) {
            while (true) {
                $num_changed = socket_select($read, $read, $NULL , 0);

                if ($num_changed) {
//                    if(in_array($socket, $read))
//                    {
//                        echo 333;
                        $client_sockets[]= socket_accept($socket);
                        echo "Принято подключение (" . count($client_sockets)  . " of clients)\n";
//                    }
                }

                foreach($client_sockets as $key => $client)
                {
                    $input = socket_read($client, 1024);
                    if($input === false)
                    {
                        socket_shutdown($client);
                        unset($client_sockets[$key]);
                    } else {
                        $input = trim($input);

                        echo $input;

                        if (!socket_write($client, "Вы сказали: $input\n") )
                        {
                            socket_close($client);
                            unset($client_sockets[$key]) ;
                        }
                    }
                    if($input == 'exit')
                    {
                        socket_shutdown($socket);
                        $abort = true;
                    }
//                    do {
////                socket_write($socket, 'sdfsdf');
//                        echo $input;
//                    } while (true);
                }
//                $connection = socket_accept($socket);
                // Поток вывода меняется на консоль

                $read[] = $socket;
            }



        } else {
            $socket = socket_create(AF_UNIX, SOCK_STREAM, 0);

            $connection = socket_connect($socket, '/tmp/socket' . $this::socket . '.sock');
//            socket_write($socket, 'hello');

            do {
                $a = readline('');
                socket_write($socket, $a);

                $input = socket_read($socket, 1024);
                echo $input;
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