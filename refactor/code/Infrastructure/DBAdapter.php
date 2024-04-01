<?php

namespace Infrastructure;

use PDO;
use PDOStatement;
use Presentation\Contracts\Connection;
use Presentation\Contracts\StorageAdapter;

class DBAdapter implements StorageAdapter
{
    private PDO $pdo;
    private PDOStatement $selectStatement;
    private PDOStatement $selectAllStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $deleteStatement;

    public function __construct(Connection $dbConnect)
    {
        $this->pdo = $dbConnect->createConnection();

        $this->selectStatement = $this->pdo->prepare('SELECT * FROM heroes WHERE nickname = ?');
        $this->selectAllStatement = $this->pdo->prepare('SELECT * FROM heroes');
        $this->insertStatement = $this->pdo->prepare(
            'INSERT INTO heroes (nickname, real_name, super_force) VALUES (?, ?, ?)'
        );
        $this->updateStatement = $this->pdo->prepare(
            'UPDATE heroes SET nickname = ?, real_name = ?, super_force = ? WHERE id = ?'
        );
        $this->deleteStatement = $this->pdo->prepare('DELETE FROM heroes WHERE id = ?');
    }

    public function selectByNickname(string $nickname)
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute([$nickname]);

        return $this->selectStatement->fetch();
    }

    public function selectAll()
    {
        $this->selectAllStatement->execute();

        return $this->selectAllStatement->fetchAll();
    }

    public function insert($data): int
    {
        $this->insertStatement->execute($data);

        return $this->pdo->lastInsertId();
    }

    public function update($data): bool
    {
        return $this->updateStatement->execute($data);
    }

    public function deleteById(int $id): bool
    {
        return $this->deleteStatement->execute([$id]);
    }
}
