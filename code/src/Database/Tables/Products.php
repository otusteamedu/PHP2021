<?php

namespace App\Database\Tables;

class Products
{
    private array $columns;
    private array $permanentColumns;
    private string $tableName;

    public function getСolumns() :array
    {
        $this->columns = [
            'name',
            'price',
            'category'
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
        $this->tableName = 'products';

        return $this->tableName;
    }


}