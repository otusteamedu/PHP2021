<?php

namespace App\Domain;

class Event
{
    private ?string $event;
    private array $conditions;
    private ?int $priority;

    /**
     * @param string|null $event
     * @param array       $conditions
     * @param int|null    $priority
     */
    public function __construct(
        ?string $event,
        array $conditions,
        ?int $priority
    ) {
        $this->event = $event;
        $this->conditions = $conditions;
        $this->priority = $priority;
    }

    public function isValid(): bool
    {
        if ($this->event === null || $this->priority === null
            || empty($this->conditions)
        ) {
            return false;
        }

        return true;
    }

    /**
     * @return string|null
     */
    public function getEvent(): ?string
    {
        return $this->event;
    }

    /**
     * @return array
     */
    public function getConditions(): array
    {
        return $this->conditions;
    }

    /**
     * @return int|null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }
}
