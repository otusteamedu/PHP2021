<?php

declare(strict_types=1);

namespace App\Services\Events\DTO;



use App\Services\Events\DTO\Exceptions\EventFormatFromArrayException;

final class EventDTO
{

    /**
     * @var int
     */
    private int $priority;

    /**
     * @var array
     */
    private array $conditions;

    /**
     * @var string
     */
    private string $event;

    /**
     * @param int $priority
     * @param array $conditions
     * @param string $event
     */
    public function __construct(
        int    $priority,
        array  $conditions,
        string $event
    )
    {
        $this->priority = $priority;
        $this->conditions = $conditions;
        $this->event = $event;
    }

    /**
     * @param array $data
     * @return static
     * @throws EventFormatFromArrayException
     */
    public static function fromArray(array $data): self
    {
        if (
            !isset($data['priority'])
            || !is_numeric($data['priority'])
            || !isset($data['conditions'])
            || !is_array($data['conditions'])
            || !isset($data['event'])
            || !is_string($data['event'])
        ) {
            throw new EventFormatFromArrayException('Неверный формат входных данных! '
                . '(Пример: {"priority": 10, "conditions": { "param1": 1, "param2": 2 }, "event": "event1"})');
        }
        return new static(
            $data['priority'],
            $data['conditions'],
            $data['event'],
        );
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
