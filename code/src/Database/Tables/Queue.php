<?php

namespace App\Database\Tables;

class Queue
{
    private array $columns;
    private array $permanentColumns;
    private string $tableName;

    public function getСolumns() :array
    {
        $this->columns = [
            'status'
        ];

        return $this->columns;
    }

    public function getPermanentColumns() :array
    {
        $this->permanentColumns = [
            'modified' => date('Y-m-d')
        ];

        return $this->permanentColumns;
    }

    public function getTableName() :string
    {
        $this->tableName = 'queue';

        return $this->tableName;
    }


}