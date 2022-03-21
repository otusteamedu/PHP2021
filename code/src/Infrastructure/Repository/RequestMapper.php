<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use Exception;
use PDO;
use PDOStatement;
use App\Domain\Entity\Request;

class RequestMapper
{
    private PDO          $pdo;
    private PDOStatement $selectStatement;
    private PDOStatement $selectAllStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $deleteStatement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->selectStatement = $pdo->prepare(
            'SELECT * FROM requests WHERE id = ?'
        );
        $this->insertStatement = $pdo->prepare(
            'INSERT INTO requests (first_name, email, phone, date1, date2, status) VALUES (?, ?, ?, ?, ?, ?)'
        );
        $this->updateStatement = $pdo->prepare(
            'UPDATE requests SET status = ? WHERE id = ?'
        );
        $this->deleteStatement = $pdo->prepare(
            'DELETE FROM requests WHERE id = ?'
        );
    }

    public function findById(int $id): ?Request
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute([$id]);

        $result = $this->selectStatement->fetch();

        if(!is_array($result)) return null;

        $request = new Request(
            (string)$result['first_name'],
            (string)$result['email'],
            (string)$result['phone'],
            (string)$result['date1'],
            (string)$result['date2']
        );

        $request->setStatus((bool)$result['status']);
        return $request;
    }

    public function insert(Request $request): Request
    {
        $this->insertStatement->execute([
            $request->getFirstname(),
            $request->getEmail(),
            $request->getPhone(),
            $request->getDate1(),
            $request->getDate2(),
            0
        ]);

        $lastId = (int)$this->pdo->lastInsertId();
        $request->setId($lastId);

        return $request;
    }

    public function update(int $id): bool
    {
        return $this->updateStatement->execute([
            TRUE,
            $id
        ]);
    }

    public function select(): ?array
    {
        $result = $this->pdo->query('SELECT * FROM requests')->fetchAll(PDO::FETCH_ASSOC);
        if(!is_array($result)) return null;

        return $result;
    }

    public function delete(Request $request): bool
    {
        return $this->deleteStatement->execute([$request->getId()]);
    }
}