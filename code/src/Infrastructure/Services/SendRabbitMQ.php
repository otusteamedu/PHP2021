<?php
declare(strict_types=1);
namespace App\Infrastructure\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class SendRabbitMQ
{
    private string $queue = 'telegram_queue';

    public function __construct()
    {
        include($_SERVER['DOCUMENT_ROOT']."/config/amqconfig.php");
    }

    public function execute(string $message)
    {

        $connection = new AMQPStreamConnection(HOST,PORT,USER,PASS);
        $channel = $connection->channel();
        $channel->queue_declare($this->queue, false, true, false, false);
        $data = new AMQPMessage($message,['delivery_mode' => 2]);
        $channel->basic_publish($data,'',$this->queue);
        $channel->close();
        $connection->close();
    }
}