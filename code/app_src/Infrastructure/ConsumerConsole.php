<?php

namespace App\Infrastructure;

class ConsumerConsole extends Consumer
{
    public function runFromQueue(string $queueName): array
    {
        $this->createConsume($queueName);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }

        $this->closeConnection();

        return $this->bankStatements;
    }

    protected function onConsume()
    {
        return function ($request) {
            $statementData = json_decode($request->body, true);
            $sendResult = $this->sendBankStatement($statementData);

            if ($sendResult) {
                echo "Банковская выписка отправлена пользователю на почту: {$statementData['email']}" . PHP_EOL;
            } else {
                echo "Ошибка отправики банковской выписки пользователю на почту {$statementData['email']}" . PHP_EOL;
            }

            $this->channel->basic_ack($request->delivery_info['delivery_tag']);
        };
    }
}
