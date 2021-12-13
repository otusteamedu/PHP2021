<?php

namespace App\Interfaces;

interface EntityPostInterface
{
    public function getId(): int;

    public function setId(int $id): self;

    public function getTitle(): string;

    public function setTitle(string $title): self;

    public function getAuthorName(): string;

    public function setAuthorName(string $authorName): self;

    public function getCreatedAt(): string;

    public function setCreatedAt(string $createdAt): self;

    public function setAttributes(
        int    $id,
        string $title,
        string $authorName,
        string $createdAt
    ): self;
}