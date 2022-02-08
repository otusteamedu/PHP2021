<?php


namespace App\Application\Services;


use App\Application\DTO\QueueConnectionDTO;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;

abstract class AbstractCodeAction
{
    protected $connection;
    protected $exchange;
    protected $queue;
    protected $channel;

    public function __construct(QueueConnectionDTO $connection, $exchange, $queue)
    {
        $this->connection = new AMQPStreamConnection(
            $connection->host,
            $connection->port,
            $connection->user,
            $connection->pass,
            $connection->vhost,
        );
        $this->exchange = $exchange;
        $this->queue = $queue;
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($this->queue);
        $this->channel->exchange_declare($this->exchange, AMQPExchangeType::DIRECT);
        $this->channel->queue_bind($this->queue, $this->exchange);
    }
}