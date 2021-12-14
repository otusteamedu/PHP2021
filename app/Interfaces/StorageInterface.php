<?php

namespace App\Interfaces;

use App\Entities\Post;

interface StorageInterface
{
    public function findById(int $id);

    public function insert(array $rawPostData);

    public function update(Post $post);

    public function delete(int $id);
}