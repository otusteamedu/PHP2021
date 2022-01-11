<?php

namespace App\Rabbit;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Connection
{
    private object $connection;

    public function Connection(): object
    {
        $this->connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');

        return $this->connection;

    }
}