<?php

namespace App\Database\Request;

use App\Postgresql\ConnectPDO;

class Update
{
    private int $id;
    private string $tableName;
    private $data;
    private array $permanentColumns;
    private object $pdo;
    private string $sql;
    private $update;
    private $params;

    public function __construct(int $id, string $tableName, array $data, array $permanentColumns)
    {
        $this->id = $id;
        $this->tableName = $tableName;
        $this->data = $data;
        $this->permanentColumns = $permanentColumns;
    }

    public function Update() :array
    {
        $this->pdo = (new ConnectPDO())->Connect();

        $this->data = array_merge($this->data, $this->permanentColumns);

        foreach ($this->data as $key => $value) {
            
            $this->params[] = '' . $key . ' = :' . $key . '';

        }

        $this->params = implode(", ",$this->params);

        $this->sql = "UPDATE $this->tableName SET $this->params WHERE id = $this->id";
        $this->update = $this->pdo->prepare($this->sql);
        $this->update->execute($this->data);

        $this->result = [
            'code' => '200',
            'message' => 'Товар был обнавлен.'
        ];

        return $this->result;
    }

}