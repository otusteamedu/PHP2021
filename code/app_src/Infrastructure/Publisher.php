<?php

namespace App\Infrastructure;

use App\Application\Interfaces\PublisherInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Closure;

class Publisher implements PublisherInterface
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;
    private string $correlationId;
    private bool $requestResult = false;

    public function __construct(AMQPStreamConnection $connection)
    {
        $this->connection = $connection;
        $this->channel = $connection->channel();
        $this->channel->confirm_select();
        $this->channel->set_ack_handler($this->success());
        $this->channel->set_nack_handler($this->fail());
    }

    public function addToQueue(array $request, string $queueName = null): bool
    {
        if (isset($queueName)) {
            $this->channel->queue_declare($queueName, false, true, false, false);
        }

        $this->correlationId = uniqid();

        $msg = new AMQPMessage(json_encode($request), ['correlation_id' => $this->correlationId, 'delivery_mode' => 2]);

        $this->channel->basic_publish($msg, '', $queueName);

        while (!$this->requestResult) {
            $this->channel->wait();
        }

        return $this->requestResult;
    }

    public function closeConnection(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    private function success(): Closure
    {
        return function (AMQPMessage $response): void {
            if ($response->get('correlation_id') === $this->correlationId) {
                $this->requestResult = true;
            }
        };
    }

    private function fail(): Closure
    {
        return function (AMQPMessage $response): void {
            if ($response->get('correlation_id') === $this->correlationId) {
                $this->requestResult = false;
            }
        };
    }
}
