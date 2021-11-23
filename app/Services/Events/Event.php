<?php

namespace App\Services\Events;



use Illuminate\Support\Collection;

class Event
{
    private int $priority;
    private string $condition;
    private string $event;

    /**
     * @param int $priority
     * @param Collection $conditions
     * @param string $event
     */
    public function __construct(int $priority, string $condition , string $event)
    {
        $this->priority = $priority;
        $this->condition = $condition;
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
     * @return Collection
     */
    public function getCondition(): string
    {
        return $this->condition;
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

}