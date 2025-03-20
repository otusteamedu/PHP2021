<?php

namespace App\Application\Adapters;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitAdapter
{
    public AMQPStreamConnection $connection;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('rabbitmq', 5672, 'mquser', 'mqpass');
    }
}
