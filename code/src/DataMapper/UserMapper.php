<?php
declare(strict_types=1);

namespace App\DataMapper;

use PDO;
use PDOStatement;

class UserMapper
{
    private PDO          $pdo;
    private PDOStatement $selectStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $deleteStatement;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->selectStatement = $pdo->prepare(
            'SELECT * FROM users WHERE id = ?'
        );
        $this->insertStatement = $pdo->prepare(
            'INSERT INTO users (first_name, last_name, age, email, status_student) VALUES (?, ?, ?, ?, ?)'
        );
        $this->updateStatement = $pdo->prepare(
            'UPDATE users SET first_name = ?, last_name = ?, age =?, email = ?, status_student = ? WHERE id = ?'
        );
        $this->deleteStatement = $pdo->prepare(
            'DELETE FROM users WHERE id = ?'
        );
    }

    public function findById(int $id): User
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute([$id]);

        $result = $this->selectStatement->fetch();

        return new User(
            $result['id'],
            $result['first_name'],
            $result['last_name'],
            $result['age'],
            $result['email'],
            $result['status_student'],
        );
    }

    public function insert(array $rawUserData): User
    {
        $this->insertStatement->execute([
            $rawUserData['first_name'],
            $rawUserData['last_name'],
            $rawUserData['age'],
            $rawUserData['email'],
            $rawUserData['status_student'],
        ]);

        return new User(
            (int)$this->pdo->lastInsertId(),
            $rawUserData['first_name'],
            $rawUserData['last_name'],
            $rawUserData['age'],
            $rawUserData['email'],
            $rawUserData['status_student'],
        );
    }

    public function update(User $user): bool
    {
        return $this->updateStatement->execute([
            $user->getFirstName(),
            $user->getLastName(),
            $user->getAge(),
            $user->getEmail(),
            $user->isStatusStudent(),
            $user->getId(),
        ]);
    }

    public function delete(User $user): bool
    {
        return $this->deleteStatement->execute([$user->getId()]);
    }
}