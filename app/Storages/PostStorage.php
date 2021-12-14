<?php

declare(strict_types=1);

namespace App\Storages;

use App\Entities\Post;
use App\Interfaces\StorageInterface;
use PDO;
use PDOStatement;

class PostStorage implements StorageInterface
{
    private PDO $pdo;

    private PDOStatement $selectStatement;

    private PDOStatement $insertStatement;

    private PDOStatement $updateStatement;

    private PDOStatement $deleteStatement;

    /**
     * @Inject({"my.specific.service"})
     */
    public function __construct()
    {
        global $app;
        $pdo = $this->pdo = $app->get('PDO');
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

    public function findById(int $id)
    {
        $this->selectStatement->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatement->execute([$id]);

        $result = $this->selectStatement->fetch();

        return $result;
    }

    public function insert(array $rawPostData)
    {
        $this->insertStatement->execute([
            $rawPostData['title'],
            $rawPostData['author_name'],
            $rawPostData['created_at'],
        ]);

        return $rawPostData;
    }

    public function update(Post $post): bool
    {
        return $this->updateStatement->execute([
            $post->getTitle(),
            $post->getAuthorName(),
            $post->getCreatedAt(),
        ]);
    }

    public function delete(int $id): bool
    {
        return $this->deleteStatement->execute([$id]);
    }
}