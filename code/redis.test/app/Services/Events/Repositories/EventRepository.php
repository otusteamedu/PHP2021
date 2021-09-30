<?php

namespace App\Services\Events\Repositories;

interface EventRepository
{
    public function add(array $params): bool;

    public function clear(): bool;

    public function getAllConditions(): array;

    public function getEvents(array $conditions): array;

    public function findEventByConditions(array $conditions): ?string;
}
