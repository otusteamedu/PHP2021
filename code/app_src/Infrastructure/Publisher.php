<?php

namespace App\Infrastructure;

use App\Application\Interfaces\PublisherInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Closure;
use Exception;

class Publisher implements PublisherInterface
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;
    private string $correlationId;
    private ?string $responseMsg;

    public function __construct(AMQPStreamConnection $connection)
    {
        $this->connection = $connection;
        $this->channel = $connection->channel();
        $this->channel->confirm_select();
        $this->channel->set_ack_handler($this->onAck());
        $this->channel->set_nack_handler($this->onNAck());
    }

    public function addToQueue(array $request, string $queueName = null): string
    {
    	if (isset($queueName)) {
	        $this->channel->queue_declare(
	            $queueName,
	            false,
	            true,
	            false,
	            false
	        );
		}
		
        $this->responseMsg = null;
        $this->correlationId = uniqid();

        $msg = new AMQPMessage(json_encode($request), [
            'correlation_id' => $this->correlationId,
            'delivery_mode'  => 2,
        ]);

        $this->channel->basic_publish($msg, '', $queueName);
        while (!isset($this->responseMsg)) {
            $this->channel->wait();
        }

        return $this->responseMsg;
    }

    public function closeConnection(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    private function onAck(): Closure
    {
        return function (AMQPMessage $response): void {
            if ($response->get('correlation_id') === $this->correlationId) {
                $this->responseMsg = 'Request accepted';
            }
        };
    }

    private function onNAck(): Closure
    {
        return function (AMQPMessage $response): void {
            if ($response->get('correlation_id') === $this->correlationId) {
                $this->responseMsg = 'Request not accepted';
            }
        };
    }
}