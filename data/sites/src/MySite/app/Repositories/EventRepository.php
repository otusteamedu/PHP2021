<?php

declare(strict_types=1);

namespace MySite\app\Repositories;


use MySite\app\Support\Entities\Event;
use MySite\app\Support\Facades\Schema;

/**
 * Class EventRepository
 * @package MySite\app\Repositories
 */
class EventRepository
{
    /**
     * @param string $key
     * @param string $event
     * @param int $priority
     * @return bool
     */
    public static function addEvent(string $key, string $event, int $priority = 0): bool
    {
        return Schema::connection()->create(
            [
                'key' => $key,
                'options' => $priority,
                'score' => $event
            ]
        );
    }

    /**
     * @param string $key
     * @return array| null
     */
    public static function findByKey(string $key): ?array
    {
        return Schema::connection()->search(
            [
                'key' => $key,
                'start' => 0,
                'end' => -1
            ]
        );
    }

    /**
     * @return array| null
     */
    public static function getAllKeys(): ?array
    {
        return Schema::connection()->get(
            [
                'keys' => '*'
            ]
        );
    }

    /**
     * @param string $key
     * @return array|null
     */
    public static function findTopPriorityByKey(string $key): ?array
    {
        return Schema::connection()->search(
            [
                'key' => $key,
                'start' => 0,
                'end' => 0,
                'reverse' => true
            ]
        );
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function deleteAllEventsByKey(string $key): bool
    {
        return Schema::connection()->delete(
            [
                'key' => $key
            ]
        );
    }

    /**
     * @return bool
     */
    public static function deleteAllEvents(): bool
    {
        return Schema::connection()->clear();
    }

    /**
     * @param Event $event
     * @return bool
     */
    public static function deleteEvent(Event $event): bool
    {
        return Schema::connection()->delete(
            [
                'key' => $event->getKey(),
                'value' => $event->getName(),
            ]
        );
    }
}
