<?php

declare(strict_types=1);

namespace App\Modules\Event\Domain\DTO;

use App\Modules\Event\Domain\Contracts\EventDTOInterface;

class CreateEventDTO implements EventDTOInterface
{
    private int $priority;
    private array $params;
    private array $events;

    public function __construct(int $priority, array $params, array $events)
    {
        $this->priority = $priority;
        $this->params = $params;
        $this->events = $events;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getEvents(): array
    {
        return $this->events;
    }
}
