<?php

declare(strict_types=1);

namespace App\DataMappers;

use App\Entities\Post;
use App\Interfaces\EntityPostInterface;
use App\Interfaces\StorageInterface;
use PDO;
use PDOStatement;

class PostMapper
{
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function findById(int $id): Post
    {
        $result = $this->storage->findById($id);
        return new Post($result);
    }

    public function insert(array $rawPostData): Post
    {
        $this->storage->insert([
            $rawPostData['title'],
            $rawPostData['author_name'],
            $rawPostData['created_at'],
        ]);

        return new Post($rawPostData);
    }

    public function update(Post $post): bool
    {
        return $this->storage->update($post);
    }

    public function delete(int $id): bool
    {
        return $this->storage->delete($id);
    }
}