<?php

namespace Elastic\Repositories\Contracts;

use Elastic\Models\Contracts\Model;

interface Repository
{
    public function getAll(): array;

    public function find(string $id): ?Model;

    public function search(array $searchParams): array;

    public function store(Model $model): ?string;

    public function delete(string $id): ?bool;
}
