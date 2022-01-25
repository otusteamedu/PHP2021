<?php

namespace App\Order\Queue;

use App\Order\Rabbit\Producer;

use App\Database\Tables\Products;
use App\Database\Tables\Queue;
use App\Database\Request\Search;
use App\Database\Request\Insert;
use App\Http\Answer;

class Create
{
    private int $id;
    private array $result;
    private object $columnsInTableSearch;
    private string $tableNameSearch;
    private object $columnsInTable;
    private string $tableName;
    private $producer;
    private $insert;
    private $lastId;

    public function __construct()
    {
        $this->id = $_POST['id'];
        $this->columnsInTableSearch = new Products();
        $this->tableNameSearch = $this->columnsInTableSearch->getTableName();
    }
    
    public function Create()
    {

        $this->result = (new Search($this->id, $this->tableNameSearch))->Search();

        if ($this->result) {

            $this->columnsInTable = new Queue();
            $this->tableName = $this->columnsInTable->getTableName();
            $this->permanentColumns = $this->columnsInTable->getPermanentColumns();

            $this->data = [
                'status' => 'Заявка принята в работу'
            ];

            $this->insert = new Insert($this->permanentColumns, $this->data, $this->tableName);
            $this->lastId = $this->insert->insert();
            $this->lastId = $this->lastId['data']['id'];

            $this->result = [
                'code' => '200',
                'message' => 'Заявка на заказа принята',
                'data' => [
                    'id' => $this->lastId,
                    'status' => $this->data['status']
                ]
            ];

            $this->producer = new Producer($this->id, $this->lastId);
            $this->producer->Producer();

        } else {

            $this->result = [
                'code' => '404',
                'message' => 'Товар не найден'
            ];

        }

        (new Answer())->Answer($this->result);
        
        
    }
}