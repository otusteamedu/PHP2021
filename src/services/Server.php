<?php

namespace Services;


class Server
{
    public $socket;

    public function __construct()
    {
        $config = parse_ini_file('config.ini');
        $socketAddress = $config['socketAddress'];
        $socketPort = $config['socketPort'];

        if (file_exists($socketAddress)) {
            unlink($socketAddress);
        }

        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        socket_bind($this->socket, $socketAddress, $socketPort);
        socket_listen($this->socket, 10);
    }


    public function run()
    {

        echo "Waiting for incoming connections... \n";
        $cont = true;
        while ($cont) {
            $client = socket_accept($this->socket);

            if (socket_getpeername($client, $address, $port)) {
                echo "Client $address : $port is now connected to us. \n";
            }

            $read = socket_read($client, 1024);

            echo "Client: $read";

            echo "Enter response: ";
            $input = fgets(STDIN);
            socket_write($client, $input);

            if ($input === 'exit') {
                $cont = false;
            }
        }
    }

    public function __destruct()
    {
        socket_close($this->socket);
        echo 'Socket close';
    }

}