<?php

namespace App\Order\Queue;

use App\Database\Tables\Queue;
use App\Database\Request\Search;
use App\Http\Answer;

class Select
{
    private string $url;
    private array $object;
    private int $id;
    private array $result; 
    private object $columnsInTable;
    private string $tableName;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->columnsInTable = new Queue();
        $this->tableName = $this->columnsInTable->getTableName();
    }

    public function Select()
    {
        $this->object = explode("/", $this->url);

        $this->id = $this->object[2];
        
        $this->result = (new Search($this->id, $this->tableName))->Search();
        
        if ($this->result) {
            
            $this->result = [
                'code' => '200',
                'message' => 'Заказ найден',
                'data' => [
                    'status' => $this->result['status']
                ]
            ];

        } else {

            $this->result = [
                'code' => '404',
                'message' => 'Заказ не найден'
            ];

        }

        (new Answer())->Answer($this->result);

    }

}