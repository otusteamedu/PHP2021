<?php

namespace App\Order\Rabbit;

use App\Order\Rabbit\Connection;
use App\Database\Request\Update;
use App\Database\Tables\Queue;

class Consumer
{
    private string $queueName;
    private $columnsInTable;
    private $tableName;
    private $permanentColumns;
    private object $connection;
    private object $channel;
    private $data;
    private $create;
    
    public function __construct()
    {
        $this->queueName = 'queueName';
        $this->columnsInTable = new Queue();
        $this->tableName = $this->columnsInTable->getTableName();
        $this->permanentColumns = $this->columnsInTable->getPermanentColumns();
    }

    public function Consumer() {

        $this->connection = (new Connection())->Connection();

        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($this->queueName, false, false, false, false);

        $callback = function($msg) {

            $this->data = $msg->body;
            $this->data = json_decode($this->data, true);
            $this->id = $this->data['queueId'];

            $this->data = [
                'status' => 'Заказ собираеться'
            ];

            sleep(30);

            $this->update = new Update($this->id, $this->tableName, $this->data, $this->permanentColumns);
            $this->result = $this->update = $this->update->Update();

            $this->data = [
                'status' => 'Заказ передан в доставку'
            ];

            sleep(120);

            $this->update = new Update($this->id, $this->tableName, $this->data, $this->permanentColumns);
            $this->result = $this->update = $this->update->Update();

            $this->data = [
                'status' => 'Закаказ доставлен в пункт выдачи'
            ];

            sleep(120);

            $this->update = new Update($this->id, $this->tableName, $this->data, $this->permanentColumns);
            $this->result = $this->update = $this->update->Update();

        };
        
        $this->channel->basic_consume($this->queueName, '', false, true, false, false, $callback);

        while(count($this->channel->callbacks)) {
            $this->channel->wait();
        }

        $this->channel->close();
        $this->connection->close();

    }

}
