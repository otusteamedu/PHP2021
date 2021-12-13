<?php

declare(strict_types=1);

namespace App\DataMappers;

use App\Interfaces\EntityPostInterface;
use PDO;
use PDOStatement;

class PostMapper
{
    private PDO          $pdo;

    private PDOStatement $selectStatement;

    private PDOStatement $insertStatement;

    private PDOStatement $updateStatement;

    private PDOStatement $deleteStatement;

    private EntityPostInterface $entity;

    public function __construct(PDO $pdo, EntityPostInterface $entity)
    {
        $this->entity = $entity;
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

    public function findById(int $id): EntityPostInterface
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute([$id]);

        $result = $this->selectStatement->fetch();

        return $this->entity->setAttributes(
            $result['id'],
            $result['title'],
            $result['author_name'],
            $result['created_at']
        );
    }

    public function insert(array $rawPostData): EntityPostInterface
    {
        $this->insertStatement->execute([
            $rawPostData['title'],
            $rawPostData['author_name'],
            $rawPostData['created_at'],
        ]);

        return $this->entity->setAttributes(
            (int)$this->pdo->lastInsertId(),
            $rawPostData['title'],
            $rawPostData['author_name'],
            $rawPostData['created_at'],
        );
    }

    public function update(): bool
    {
        return $this->updateStatement->execute([
            $this->entity->getTitle(),
            $this->entity->getAuthorName(),
            $this->entity->getCreatedAt(),
        ]);
    }

    public function delete(int $id): bool
    {
        return $this->deleteStatement->execute([$this->entity->getId()]);
    }
}