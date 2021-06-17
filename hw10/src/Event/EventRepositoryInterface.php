<?php

namespace App\Event;

interface EventRepositoryInterface
{
    public function add(array $conditions, array $event, int $priority = 0);

    public function findOneWithHighestPriorityByConditions(array $conditions): ?array;

    public function findAllByConditions(array $conditions): array;

    public function deleteAllEventsByConditions(array $conditions): int;

    public function deleteOneEvent(array $conditions, array $event): int;

    public function flush();
}
