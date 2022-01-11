<?php

namespace App\Rabbit;

use App\Rabbit\Connection;
use PhpAmqpLib\Message\AMQPMessage;

class Producer {

    private string $queueName;
    private $message;
    private object $connection;
    private object $channel;

    public function __construct(array $data)
    {
        $this->queueName = 'queueName';
        $this->message = [
            'chatId' => $data['chatId'],
            'dateWith' => $data['dateWith'],
            'dateBeforee'=> $data['dateBeforee']
        ];
    }

    public function Producer() {

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