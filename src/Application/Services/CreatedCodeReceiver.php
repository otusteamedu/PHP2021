<?php


namespace App\Application\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class CreatedCodeReceiver extends AbstractCodeAction
{
    private $consumer;

    public function __construct(AMQPStreamConnection $connection, $exchange, $queue, $consumer)
    {
        parent::__construct($connection, $exchange, $queue);
        $this->consumer = $consumer;
    }

    public function receive()
    {
        $this->channel->basic_consume($this->queue, $this->consumer, false, false, false, false, function ($message) {
            echo "\n--------\n";
            echo $message->body;
            echo "\n--------\n";
            $message->ack();
            mail(EMAIL, 'band_codes', $message->body);
        });
        register_shutdown_function(function ($channel, $connection) {
            $channel->close();
            $connection->close();
        }, $this->channel, $this->connection);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }
}