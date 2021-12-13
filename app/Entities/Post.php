<?php

declare(strict_types=1);

namespace App\Entities;

use App\Interfaces\EntityPostInterface;

class Post implements EntityPostInterface
{
    private int    $id;

    private string $title;

    private string $authorName;

    private string $createdAt;



    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setAttributes(int $id, string $title, string $authorName, string $createdAt): EntityPostInterface
    {
        $this->id = $id;
        $this->title = $title;
        $this->authorName = $authorName;
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): Post
    {
        $this->createdAt = $createdAt;

        return $this;
    }

}