<?php

namespace App\Services\Events\Repositories;

use App\Services\Events\DTO\EventDTO;

interface EventRepository
{
    public function add(EventDTO $params): bool;

    public function clear(): bool;

    public function getAllConditions(): array;

    public function getEvents(array $conditions): array;

    public function findEventByConditions(array $conditions): ?string;
}
