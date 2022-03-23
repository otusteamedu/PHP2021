<?php

namespace App\Infrastructure;

use App\Application\Contracts\ConsumerInterface;
use App\Application\Contracts\EventServiceInterface;
use App\Utils\ConsoleOutput;
use Closure;
use Exception;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Consumer implements ConsumerInterface
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;
    private EventServiceInterface $service;

    /**
     * @param AMQPStreamConnection $connection
     */
    public function __construct(
        AMQPStreamConnection $connection,
        EventServiceInterface $service
    ) {
        $this->connection = $connection;
        $this->channel = $connection->channel();
        $this->channel->queue_declare(
            self::QUEUE_NAME,
            false,
            true,
            false,
            false
        );
        $this->service = $service;
    }

    /**
     * @throws Exception
     */
    public function execute(): void
    {
        $this->channel->basic_qos(null, 1, null);
        $this->channel->basic_consume(
            self::QUEUE_NAME,
            '',
            false,
            false,
            false,
            false,
            $this->onReq()
        );

        while ($this->channel->is_open()) {
            $this->channel->wait();
        }

        $this->close();
    }

    /**
     * @throws Exception
     */
    private function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    private function onReq(): Closure
    {
        return function (AMQPMessage $req): void {
            $req->ack();

            $correlationId = $req->get('correlation_id');
            ConsoleOutput::info($correlationId, 'request in process');
            try {
                $this->service->execute($req->getBody());
                ConsoleOutput::info(
                    $correlationId,
                    'request successfully completed'
                );
            } catch (Exception $e) {
                ConsoleOutput::info(
                    $correlationId,
                    'request completed with errors - ' . $e->getMessage()
                );
            }
        };
    }
}
