<?php

namespace App\Database\Request;

use App\Postgresql\ConnectPDO;

class Remove
{
    private $pdo;
    private $sql;
    private $delete;
    private $id;
    private $result;

    public function __construct(int $id, string $tableName)
    {
        $this->id = $id;
        $this->tableName = $tableName;
    }

    public function Remove() :array
    {
        $this->pdo = (new ConnectPDO())->Connect();

        $this->sql = "DELETE FROM $this->tableName WHERE id = ?";

        $this->delete = $this->pdo->prepare($this->sql);
        $this->delete->execute([$this->id]);

        $this->result = [
            'code' => '200',
            'message' => 'Товар удален'
        ];

        return $this->result;
    }

}