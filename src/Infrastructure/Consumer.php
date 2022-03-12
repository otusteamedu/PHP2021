<?php

namespace App\Infrastructure;

use App\Application\Contracts\BankStatementServiceInterface;
use App\Application\Contracts\ConsumerInterface;
use App\Domain\BankStatement;
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
    private BankStatementServiceInterface $service;

    /**
     * @param AMQPStreamConnection $connection
     */
    public function __construct(
        AMQPStreamConnection $connection,
        BankStatementServiceInterface $service
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
    }

    /**
     * @throws Exception
     */
    public function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    private function onReq(): Closure
    {
        return function (AMQPMessage $req): void {
            $req->ack();

            ConsoleOutput::info(
                $req->get('correlation_id'),
                'request in process'
            );
            try {
                $body = json_decode($req->getBody(), true);
                if (is_null($body)) {
                    throw new Exception('incorrect request body');
                }
                $statement = new BankStatement(
                    $body['date_from'], $body['date_to'], $body['email']
                );
                $this->service->generate($statement);
            } catch (Exception $e) {
                ConsoleOutput::info(
                    $req->get('correlation_id'),
                    'request completed with errors - ' . $e->getMessage()
                );
            } finally {
                ConsoleOutput::info(
                    $req->get('correlation_id'),
                    'request successfully completed'
                );
            }
        };
    }
}
