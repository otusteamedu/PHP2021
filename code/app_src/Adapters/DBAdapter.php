<?php

namespace App\Adapters;

use PDO;
use PDOStatement;

class DBAdapter
{
    private PDO          $pdo;

    private PDOStatement $selectStatement;

    private PDOStatement $selectAllStatement;

    private PDOStatement $insertStatement;

    private PDOStatement $updateStatement;

    private PDOStatement $deleteStatement;

    public function __construct()
    {
        $DBConnection = new DBConnection;
        $this->pdo = $DBConnection->createConnection();

        $this->selectStatement = $this->pdo->prepare(
            'SELECT * FROM heroes WHERE id = ?'
        );
        $this->selectAllStatement = $this->pdo->prepare(
            'SELECT * FROM heroes'
        );
        $this->insertStatement = $this->pdo->prepare(
            'INSERT INTO heroes (class, name, race) VALUES (?, ?, ?)'
        );
        $this->updateStatement = $this->pdo->prepare(
            'UPDATE heroes SET class = ?, name = ?, race = ? WHERE id = ?'
        );
        $this->deleteStatement = $this->pdo->prepare(
            'DELETE FROM heroes WHERE id = ?'
        );
    }

    public function selectById(int $id)
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute([$id]);

        return $this->selectStatement->fetch();
    }

    public function selectAll()
    {
        $this->selectAllStatement->execute();

        return $this->selectAllStatement->fetchAll();
    }

    public function insert($rawData)
    {
        $this->insertStatement->execute($rawData);

        return (int)$this->pdo->lastInsertId();
    }

    public function update($rawData)
    {
        $this->updateStatement->execute($rawData);
    }

    public function deleteById($id)
    {
        $this->deleteStatement->execute([$id]);
    }
}
