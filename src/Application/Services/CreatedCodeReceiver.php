<?php


namespace App\Application\Services;

use PhpAmqpLib\Message\AMQPMessage;

class CreatedCodeReceiver extends AbstractCodeAction
{
    public function receive()
    {
        echo 666;
        exit();
        function process_message($message)
        {
            echo "\n--------\n";
            echo $message->body;
            echo "\n--------\n";

            $message->ack();
        }

        $this->channel->basic_consume($this->queue, 'consumer', false, false, false, false, 'process_message');

        /**
         * @param \PhpAmqpLib\Channel\AMQPChannel $channel
         * @param \PhpAmqpLib\Connection\AbstractConnection $connection
         */
        function shutdown($channel, $connection)
        {
            $channel->close();
            $connection->close();
        }

        register_shutdown_function('shutdown', $this->channel, $this->connection);

// Loop as long as the channel has callbacks registered
        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }
}