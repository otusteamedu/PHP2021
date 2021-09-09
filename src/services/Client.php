<?php

namespace Services;


class Client
{
    public $connect;
    public $socket;

    public function __construct()
    {
        $config = parse_ini_file('config.ini');
        $socketAddress = $config['socketAddress'];
        $socketPort = $config['socketPort'];

        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        $this->connect = socket_connect($this->socket, $socketAddress, $socketPort);

    }

    public function run()
    {
        echo "Enter message:";
        $input = fgets(STDIN);

        socket_write($this->socket, $input);
        $response = socket_read($this->socket, 1024);
        echo "Server responce:" . $response;

    }

    public function __destruct()
    {
        socket_close($this->socket);
        echo 'Socket close';
    }


}