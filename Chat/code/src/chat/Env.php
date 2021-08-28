<?php

namespace Chat;

class Env

{

    public $host;
    public $port;

    public function __construct()
    {
        $this->host = '../socket/socket.sock';
        $this->host = '0';
    }
}