<?php
declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Infrastructure\Repository\RequestRepository;
use PhpAmqpLib\Connection\AMQPStreamConnection;


class ReceiverRabbitMQ
{
    private string $queue = 'request_queue';

    public function __construct(){
        $config = ROOT .'/config/amqpconfig.php';
        include($config);
    }

    public function execute()
    {
        $connection = new AMQPStreamConnection(HOST,PORT,USER,PASS);
        $channel = $connection->channel();

        $channel->queue_declare($this->queue, false, true, false, false);

        echo "<br> * Waiting for messages<br>";

        $callback = function($msg){

            echo " * Message received<br>";
            $data = json_decode($msg->body);


            echo $id = $data->id;

            sleep(10);
            (new RequestRepository())->updateStatusRequest($id);

           echo " * Message was sent<br>";

        };

        $channel->basic_consume('request_queue', '', false, false, false, false, $callback);

        while(count($channel->callbacks)){
            $channel->wait();
        }

        $channel->close();
        $connection->close();

    }

}