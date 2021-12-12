<?php

declare(strict_types=1);

namespace App\DataMappers;

use App\Entities\Post;
use PDO;
use PDOStatement;

class PostMapper
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
            'SELECT * FROM posts WHERE id = ?'
        );
        $this->insertStatement = $pdo->prepare(
            'INSERT INTO posts (title, author_name, created_at) VALUES (?, ?, ?)'
        );
        $this->updateStatement = $pdo->prepare(
            'UPDATE posts SET title = ?, author_name = ?, created_at = ? WHERE id = ?'
        );
        $this->deleteStatement = $pdo->prepare(
            'DELETE FROM posts WHERE id = ?'
        );
    }

    public function findById(int $id): Post
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute([$id]);

        $result = $this->selectStatement->fetch();

        return new Post(
            $result['id'],
            $result['title'],
            $result['author_name'],
            $result['created_at'],
        );
    }

    public function insert(array $rawUserData): Post
    {
        $this->insertStatement->execute([
            $rawUserData['first_name'],
            $rawUserData['last_name'],
            $rawUserData['email'],
        ]);

        return new User(
            (int)$this->pdo->lastInsertId(),
            $rawUserData['first_name'],
            $rawUserData['last_name'],
            $rawUserData['email'],
        );
    }

    public function update(Post $user): bool
    {
        return $this->updateStatement->execute([
            $user->getTitle(),
            $user->getAuthorName(),
            $user->getCreatedAt(),
        ]);
    }

    public function delete(Post $user): bool
    {
        return $this->deleteStatement->execute([$user->getId()]);
    }
}