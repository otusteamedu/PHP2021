<?php

namespace App\Product\Action;

use App\Database\Tables\Products;
use App\Database\Request\Search;
use App\Database\Request\Remove;
use App\Http\Answer;

class Delete
{
    
    private string $url;
    private object $columnsInTable;
    private array $object;
    private int $id;
    private array $search;
    private array $remove;
    private array $result;

    public function __construct()
    {

        $this->url = $_SERVER['REQUEST_URI'];

        $this->columnsInTable = new Products();
        $this->tableName = $this->columnsInTable->getTableName();

    }

    public function Delete()
    {
        $this->object = explode("/", $this->url);

        $this->id = $this->object[2];

        $this->search = (new Search($this->id, $this->tableName))->Search();

        if ($this->search) {
                
            $this->remove = (new Remove($this->id, $this->tableName))->Remove();
            $this->result = $this->remove;

        } else {

            $this->result = [
                'code' => '404',
                'message' => 'Товар не найден'
            ];

        }

        (new Answer())->Answer($this->result);

    }
}