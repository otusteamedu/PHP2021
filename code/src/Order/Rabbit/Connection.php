<?php

namespace App\Order\Rabbit;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Connection
{
    private object $connection;
    private $host;
    private $port;
    private $user;
    private $pass;

    public function __construct()
    {
        $this->host = 'rabbitmq';
        $this->port = 5672;
        $this->user = 'guest';
        $this->pass = 'guest';
    }

    public function Connection(): object
    {
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->pass);

        return $this->connection;

    }
}