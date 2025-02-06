<?php

namespace App\Infrastructure;

use App\Application\Interfaces\ConsumerInterface;
use App\Application\Interfaces\MailAgentInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

abstract class Consumer implements ConsumerInterface
{
    protected AMQPStreamConnection $connection;
    protected AMQPChannel $channel;
    protected MailAgentInterface $mailAgent;
    protected $bankStatements = [];

    public function __construct(AMQPStreamConnection $connection, MailAgentInterface $mailAgent)
    {
        $this->connection = $connection;
        $this->channel = $connection->channel();
        $this->mailAgent = $mailAgent;
    }


    public function closeConnection(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    protected function createConsume($queueName): void
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
    }

    protected function sendBankStatement($data): bool
    {
        return $this->mailAgent->send(
            $data['email'],
            'Ваша выписка готова',
            "Ваша банковская выписка с {$data['date_from']} до {{$data['date_to']}}"
        );
    }

    abstract protected function onConsume();
}
