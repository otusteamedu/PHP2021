<?php

namespace App\Product\Action;

use App\Database\Tables\Products;
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
        $this->columnsInTable = new Products();
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
                'message' => 'Товар найден',
                'data' => [
                    'id' => $this->result['id'],
                    'name' => $this->result['name'],
                    'category' => $this->result['category']
                ]
            ];

        } else {

            $this->result = [
                'code' => '404',
                'message' => 'Товар не найден'
            ];

        }

        (new Answer())->Answer($this->result);

    }

}