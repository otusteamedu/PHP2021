<?php

declare(strict_types=1);

namespace App\RowGateway;

use PDO;
use PDOStatement;

class UserFinder
{
    private PDO          $pdo;

    private PDOStatement $selectStatement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->selectStatement = $pdo->prepare('SELECT * FROM users LIMIT 10');
    }

    public function findCollection()
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute();

        $collection = [];

        while($row = $this->selectStatement->fetch())
        {
            $collection[] = (new User())
                ->setId((int) $row['id'])
                ->setName($row['name'])
                ->setPhone($row['phone'])
                ->setEmail($row['email']);
        }

        return $collection;
    }
}
