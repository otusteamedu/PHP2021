<?php

namespace App;

use App\Exceptions\InvalidInstanceTypeException;

class SocketAppFactory
{
    private $port;
    private $host;

    public function __construct()
    {
        $this->host = $_ENV['SOCKET_PATH'];
        $this->port = $_ENV['SOCKET_PORT'];
    }

    public function createInstance($type = null)
    {
        switch ($type) {
            case 'client':
                return new Client($this->host, $this->port);
            case 'server':
                return new Server($this->host, $this->port);
            default:
                throw new InvalidInstanceTypeException('Invalid instance type');
        }
    }
}