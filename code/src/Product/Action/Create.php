<?php

namespace App\Product\Action;

use App\Product\Validate\Validate;
use App\Database\Tables\Products;
use App\Database\Request\Insert;
use App\Http\Answer;

class Create
{

    private array $data;
    private object $columnsInTable;
    private array $permanentColumns;
    private array $incomingColumns;
    private string $tableName; 
    private array $checking;
    private object $insert;
    private array $result;

    public function __construct()
    {
        $this->data = $_POST;

        $this->columnsInTable = new Products();
        $this->permanentColumns = $this->columnsInTable->getPermanentColumns();
        $this->incomingColumns = $this->columnsInTable->getСolumns();
        $this->tableName = $this->columnsInTable->getTableName();
    }

    public function Create()
    {

        $this->checking = (new Validate())->Validate($this->data, $this->incomingColumns);

        if (!$this->checking) {

            $this->insert = new Insert($this->permanentColumns, $this->data, $this->tableName);
            $this->result= $this->insert->insert();

        } else {

            $this->result = $this->checking;

        }

        (new Answer())->Answer($this->result);
        
    }

}