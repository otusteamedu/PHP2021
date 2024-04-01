<?php

namespace Presentation\Contracts;

interface StorageAdapter
{
    public function __construct(Connection $dbConnect);

    public function selectByNickname(string $nickname);

    public function selectAll();

    public function insert($data): int;

    public function update($data): bool;

    public function deleteById(int $id): bool;
}
