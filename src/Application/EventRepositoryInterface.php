<?php

namespace App\Application;

use App\Domain\Event;

interface EventRepositoryInterface
{
    public function findEventByConditions(array $conditions): ?Event;

    public function createEvent(Event $event): string;

    public function clearAllEvents(): void;
}
