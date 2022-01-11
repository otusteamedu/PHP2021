<?php

namespace App\Rabbit;

use App\Rabbit\Connection;
use App\Discharge\Create;
use App\Telegram\SendDocument;

class Consumer
{
    private string $queueName;
    private object $connection;
    private object $channel;
    private string $data;
    private $create;
    
    public function __construct()
    {
        $this->queueName = 'queueName';
    }

    public function Consumer() {

        $this->connection = (new Connection())->Connection();

        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($this->queueName, false, false, false, false);

        $callback = function($msg) {

            $this->data = $msg->body;

            $this->create = new Create($this->data);
            $this->create = $this->create->Create();

            echo $this->data . "\n";

            new SendDocument($this->create);

        };
        
        $this->channel->basic_consume($this->queueName, '', false, true, false, false, $callback);

        while(count($this->channel->callbacks)) {
            $this->channel->wait();
        }

        $this->channel->close();
        $this->connection->close();

    }

}
