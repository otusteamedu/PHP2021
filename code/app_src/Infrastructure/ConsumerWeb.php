<?php

namespace App\Infrastructure;

use PhpAmqpLib\Exception\AMQPTimeoutException;

class ConsumerWeb extends Consumer
{
    public function runFromQueue(string $queueName): array
    {
        $this->createConsume($queueName);

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

    protected function onConsume()
    {
        return function ($request) {
            $statementData = json_decode($request->body, true);

            $this->bankStatements[] = $statementData;
            $this->sendBankStatement($statementData);
            $this->channel->basic_ack($request->delivery_info['delivery_tag']);
        };
    }
}
