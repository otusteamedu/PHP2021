<?php declare(strict_types=1);

namespace App\DataMapper;

use PDO;
use PDOStatement;

class UserMapper
{
    private PDO $pdo;
    private PDOStatement $selectStatement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->selectStatement = $pdo->prepare('SELECT * FROM users');
    }

    public function findCollection(): array
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute();

        $collection = [];

        while($row = $this->selectStatement->fetch())
        {
            $collection[] = new User(
                $row['id'],
                $row['name'],
                $row['phone'],
                $row['email']
            );
        }

        return $collection;
    }
}
