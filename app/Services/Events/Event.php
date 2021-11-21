<?php

namespace App\Services\Events;

class Event
{
    private int $priority;
    private array $conditions;
    private string $event;

    /**
     * @param int $priority
     * @param array $conditions
     * @param string $event
     */
    public function __construct(int $priority, array $conditions , string $event)
    {
        $this->priority = $priority;
        $this->conditions = $conditions;
        $this->event = $event;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return array
     */
    public function getConditions(): array
    {
        return $this->conditions;
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

}