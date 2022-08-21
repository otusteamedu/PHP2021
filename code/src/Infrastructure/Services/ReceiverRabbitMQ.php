<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class ReceiverRabbitMQ
{
    private string $queue = 'telegram_queue';

    public function __construct()
    {
        include($_SERVER['DOCUMENT_ROOT']."/config/amqpconfig.php");
    }

    public function execute()
    {
        $connection = new AMQPStreamConnection(HOST,PORT,USER,PASS);
        $channel = $connection->channel();
        $channel->queue_declare($this->queue,false,true,false,false);
        echo "wait...";
        $callback = function ($msg) {
            echo 'received';
            $data = json_decode($msg->body,true);

            $name = $data['name'];
            $phone = $data['phone'];
            $email = $data['email'];
            $dateFrom = $data['dateFrom'];
            $dateTo = $data['dateTo'];

            echo 'sent';

            $token = "5785526766:AAH6EAMP6mIEXGDiX5baszQNCNUa0-GAahI";
            $chatId = "-1001416225462";

            $msg = "Ваша заявка на выписку из банка принята! \n\nE-mail: {$email} \nТелефон: {$phone} \n
            Имя: {$name} \n\nВыписка с: {$dateFrom} - по: {$dateTo}";
            file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chatId}&text={$msg}");
        };

        $channel->basic_consume('telegram_queue','',false,false,false,false,$callback);

        while(count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}