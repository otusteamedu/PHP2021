<?php

namespace App\Infrastructure;

use App\Application\Interfaces\ConsumerInterface;
use App\Application\Interfaces\StorageInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPTimeoutException;
use Closure;

class Consumer implements ConsumerInterface
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;
    private StorageInterface $storage;
    protected array $bankStatements = [];

    public function __construct(AMQPStreamConnection $connection, StorageInterface $storage)
    {
        $this->connection = $connection;
        $this->channel = $connection->channel();
        $this->storage = $storage;
    }

    public function runFromQueue(string $queueName): array
    {
        $this->channel->queue_declare($queueName, false, true, false, false);
        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume(
            $queueName,
            '',
            false,
            false,
            false,
            false,
            $this->onConsume()
        );

        while ($this->channel->is_consuming()) {
            try {
                $this->channel->wait(null, false, 1);
            } catch (AMQPTimeoutException $error) {
                break;
            }
        }

        $this->closeConnection();

        return $this->bankStatements;
    }

    public function closeConnection(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    private function onConsume(): Closure
    {
        return function ($request) {
            $statementData = json_decode($request->body, true);
            $this->bankStatements[] = $statementData;

            $this->channel->basic_ack($request->delivery_info['delivery_tag']);
        };
    }
}
