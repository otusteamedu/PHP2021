<?php

declare(strict_types=1);

namespace App\TableGateway;

use PDO;
use PDOStatement;

class User
{
    private PDO          $pdo;

    private PDOStatement $selectStatement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->selectStatement = $pdo->prepare('SELECT * FROM users LIMIT 10');
    }

    public function findCollection(): array
    {
        $this->selectStatement->execute();

        return $this->selectStatement->fetchAll(PDO::FETCH_ASSOC);
    }
}
