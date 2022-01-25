<?php

namespace App\Database\Request;

use App\Postgresql\ConnectPDO;

class Search
{
    private int $id;
    private string $tableName;
    private array $result = [];
    private object $pdo;
    private string $sql;
    private object $select;

    public function __construct(int $id, string $tableName)
    {
        $this->id = $id;
        $this->tableName = $tableName;
    }

    public function Search() :array
    {
        $this->pdo = (new ConnectPDO())->Connect();

        $this->sql = "SELECT * FROM $this->tableName WHERE id = :id";

        $this->select = $this->pdo->prepare($this->sql);

        $this->select->execute([
            'id' => $this->id
        ]);

        $this->search = $this->select->fetch();

        if ($this->search) {
            $this->result = $this->search;
        }
        
        return $this->result;
    }

}