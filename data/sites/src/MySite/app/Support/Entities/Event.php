<?php

declare(strict_types=1);

namespace MySite\app\Support\Entities;

use MySite\app\Support\Traits\EventTools;

/**
 * Class Event
 * @package MySite\app\Support\Entities
 */
class Event
{
    use EventTools;

    public function __construct(
        private string $key,
        private ?string $name = null,
        private int $priority = 0
    ) {
    }

    /**
     * @param string $key
     * @return Event
     */
    public function setKey(string $key): Event
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param string|null $name
     * @return Event
     */
    public function setName(?string $name): Event
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $priority
     * @return Event
     */
    public function setPriority(int $priority): Event
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @param string $json
     * @return Event
     */
    public static function fromJson(string $json): Event
    {
        $event = json_decode($json, true);

        $key = self::createKey($event['conditions']);

        return new self(
            $key,
            $event['event'] ?? null,
            (int)$event['priority']
        );
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}
