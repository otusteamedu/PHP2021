<?php

namespace App\Database\Request;

use App\Postgresql\ConnectPDO;

class Insert
{

    private array $permanentColumns;
    private array $incomingColumns;
    private string $tableName;
    private $columns;
    private $values;
    private $columnsValues;
    private $columnsInto;
    private $pdo;
    private $sql;
    private $insert;
    private $result;
    private $lastInsertId;

    public function __construct(array $permanentColumns, array $incomingColumns, string $tableName)
    {
        $this->permanentColumns = $permanentColumns;
        $this->incomingColumns = $incomingColumns;
        $this->tableName = $tableName;
    }

    public function Insert() :array
    {
        foreach ($this->permanentColumns as $column => $value) {
            $this->columns[] = $column;
            $this->values[$column] = $value;
        }

        foreach ($this->incomingColumns as $column => $value) {
            $this->columns[] = $column;
            $this->values[$column] = $value;
        }

        $this->columnsInto = implode(", ", $this->columns);

        foreach ($this->columns as $value) {
            $this->columnsValues[] = ':' . $value;
        }

        $this->columnsValues = implode(", ", $this->columnsValues);

        $this->pdo = (new ConnectPDO())->Connect();

        $this->sql = "INSERT INTO $this->tableName ($this->columnsInto) VALUES ($this->columnsValues)";

        $this->insert = $this->pdo->prepare($this->sql);
        $this->insert->execute($this->values);
        
        $this->lastInsertId = $this->pdo->lastInsertId();
        
        $this->result = [
            'code' => '201',
            'message' => 'Товар был создан.',
            'data' => [
                'id' => $this->lastInsertId,
            ]
        ];

        return $this->result;
    }
}