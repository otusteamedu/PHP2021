<?php

namespace App\Application\Contracts;

use App\Domain\Event;

interface EventRepositoryInterface
{
    public function findById(string $id): ?Event;

    public function create(Event $event): void;

    public function update(Event $event): void;
}