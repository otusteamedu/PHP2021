<?php

declare(strict_types=1);

namespace App\DataMappers;

use App\Entities\Post;
use App\Interfaces\EntityInterface;
use PDO;
use PDOStatement;

class PostMapper
{
    private PDO          $pdo;

    private PDOStatement $selectStatement;

    private PDOStatement $insertStatement;

    private PDOStatement $updateStatement;

    private PDOStatement $deleteStatement;

    private EntityInterface $entity;

    public function __construct(PDO $pdo, EntityInterface $entity)
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

    public function findById(int $id): EntityInterface
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute([$id]);

        $result = $this->selectStatement->fetch();

        return (new Post())->setAttributes(
            $result['id'],
            $result['title'],
            $result['author_name'],
            $result['created_at']
        );
    }

    public function insert(array $rawPostData): Post
    {
        $this->insertStatement->execute([
            $rawPostData['title'],
            $rawPostData['author_name'],
            $rawPostData['created_at'],
        ]);

        return new Post(
            (int)$this->pdo->lastInsertId(),
            $rawPostData['title'],
            $rawPostData['author_name'],
            $rawPostData['created_at'],
        );
    }

    public function update(Post $post): bool
    {
        return $this->updateStatement->execute([
            $post->getTitle(),
            $post->getAuthorName(),
            $post->getCreatedAt(),
        ]);
    }

    public function delete(Post $post): bool
    {
        return $this->deleteStatement->execute([$post->getId()]);
    }
}