<?php

namespace App\Application;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;


class MessageController
{
    private $connection;
    private $channel;

    public function __construct()
    {
        $exchange = 'router';
        $queue = 'msgs';
        $this->connection = new AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($queue, false, true, false, false);
        $this->channel->exchange_declare($exchange, AMQPExchangeType::DIRECT, false, true, false);
        $this->channel->queue_bind($queue, $exchange);
    }

    public function send($code)
    {
        $exchange = 'router';
        $messageBody = $code;
        $message = new AMQPMessage($messageBody, array('content_type' => 'text/plain', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
        $this->channel->basic_publish($message, $exchange);
        $this->channel->close();
        $this->connection->close();
        echo 'code sent';
    }


}