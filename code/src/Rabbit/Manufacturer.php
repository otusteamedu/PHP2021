<?php

namespace App\Rabbit;

use PhpAmqpLib\Message\AMQPMessage;

class Manufacturer {

    private string $queueName;
    private $message;
    private object $connection;
    private object $channel;

    public function __construct(array $data)
    {
        $this->queueName = 'queueName';
        $this->message = $data;
    }

    public function Manufacturer() {

        $this->message = json_encode($this->message);

        $this->connection = (new Connection())->Connection();

        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($this->queueName, false, false, false, false);

        $this->message = new AMQPMessage($this->message);

        $this->channel->basic_publish($this->message, '', $this->queueName);

        $this->channel->close();
        $this->connection->close();

    }

}