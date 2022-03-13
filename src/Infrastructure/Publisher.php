<?php

namespace App\Infrastructure;

use App\Application\Contracts\PublisherInterface;
use App\DTO\Request;
use App\DTO\Response;
use Closure;
use Exception;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Publisher implements PublisherInterface
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;
    private ?Response $response;
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
     * @throws Exception
     */
    public function execute(string $routingKey, Request $req): Response
    {
        $this->response = null;
        $this->correlationId = uniqid();

        $msg = new AMQPMessage($req->getBody(), [
            'correlation_id' => $this->correlationId,
            'delivery_mode'  => AMQPMessage::DELIVERY_MODE_PERSISTENT,
        ]);

        $this->channel->basic_publish($msg, '', $routingKey);
        while (is_null($this->response)) {
            $this->channel->wait();
        }

        return $this->response;
    }

    /**
     * @throws Exception
     */
    public function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    private function onAck(): Closure
    {
        return function (AMQPMessage $resp): void {
            if ($resp->get('correlation_id') === $this->correlationId) {
                $this->response = new Response($resp->getBody(), 201);
            }
        };
    }

    private function onNAck(): Closure
    {
        return function (AMQPMessage $resp): void {
            if ($resp->get('correlation_id') === $this->correlationId) {
                $this->response = new Response('request not accepted for processing', 500);
            }
        };
    }
}
