<?php

namespace App\Infrastructure;

use App\Application\Contracts\PublisherInterface;
use App\DTO\EventRequest;
use App\DTO\EventResponse;
use Exception;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Closure;

class Publisher implements PublisherInterface
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;
    private ?EventResponse $response;
    private string $correlationId;

    /**
     * @param AMQPStreamConnection $connection
     */
    public function __construct(AMQPStreamConnection $connection)
    {
        $this->connection = $connection;
        $this->channel = $connection->channel();
        $this->channel->confirm_select();
        $this->channel->set_ack_handler($this->onAck());
        $this->channel->set_nack_handler($this->onNAck());
    }

    /**
     * @return Closure
     */
    private function onAck(): Closure
    {
        return function (AMQPMessage $message): void
        {
            if ($message->get('correlation_id') === $this->correlationId)
                $this->response = new EventResponse($message->getBody(), 201);
        };
    }

    /**
     * @return Closure
     */
    private function onNAck(): Closure
    {
        return function (AMQPMessage $message): void
        {
            if ($message->get('correlation_id') === $this->correlationId)
                $this->response = new EventResponse('request not accepted for processing', 500);
        };
    }

    /**
     * @param string $routingKey
     * @param EventRequest $request
     * @return EventResponse
     * @throws Exception
     */
    public function execute(string $routingKey, EventRequest $request): EventResponse
    {
        $this->response = null;
        $this->correlationId = uniqid();

        $msg = new AMQPMessage($request->getBody(), [
            'correlation_id'    => $this->correlationId,
            'delivery_mode'     => AMQPMessage::DELIVERY_MODE_PERSISTENT
        ]);

        $this->channel->basic_publish($msg, '', $routingKey);
        while (is_null($this->response)) {
            $this->channel->wait();
        }

        $this->close();

        return $this->response;
    }

    /**
     * @return void
     * @throws Exception
     */
    private function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }
}