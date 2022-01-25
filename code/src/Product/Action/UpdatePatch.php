<?php

namespace App\Product\Action;

use App\Database\Request\Update;
use App\Database\Tables\Products;
use App\Database\Request\Search;
use App\Http\Answer;

class UpdatePatch
{
    private string $url;
    private object $columnsInTable;
    private array $permanentColumns;
    private string $tableName;
    private $inputData;
    private $data;
    private array $search;
    private $update;
    private array $result;
    
    public function __construct()
    {

        $this->url = $_SERVER['REQUEST_URI'];

        $this->columnsInTable = new Products();
        $this->permanentColumns = $this->columnsInTable->getPermanentColumns();
        $this->tableName = $this->columnsInTable->getTableName();

    }

    public function UpdatePatch()
    {
        $this->object = explode("/", $this->url);

        $this->id = $this->object[2];

        $this->inputData = file_get_contents('php://input');
        $this->data = json_decode($this->inputData, true);

        if ($this->data) {

            $this->search = (new Search($this->id, $this->tableName))->Search(); 

            if ($this->search) {

                $this->update = new Update($this->id, $this->tableName, $this->data, $this->permanentColumns);
                $this->result = $this->update = $this->update->Update();

            } else {

                $this->result = [
                    'code' => '404',
                    'message' => 'Товар не найден'
                ];
            }
        
        } else {

            $this->result = [
                'code' => '400',
                'message' => 'Параметры указаны неверно'
            ];

        }

        (new Answer())->Answer($this->result);
        
    }
}