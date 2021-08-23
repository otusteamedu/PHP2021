<?php

declare(strict_types=1);

namespace MySite\app\Services;

use MySite\app\Repositories\EventRepository;
use MySite\app\Support\Entities\Event;
use MySite\app\Support\Iterators\Collection;

/**
 * Class EventService
 * @package MySite\app\Services
 */
class EventService
{

    /**
     * @param Event $event
     * @return bool
     */
    public function addEvent(Event $event): bool
    {
        return EventRepository::addEvent(
            $event->getKey(),
            $event->getName(),
            $event->getPriority()
        );
    }

    /**
     * @param string $conditions
     * @return Event|null
     */
    public function findTopEventByConditions(string $conditions): ?Event
    {
        $event = null;
        $request = EventRepository::findTopPriorityByKey($conditions);
        if ($request) {
            $event = new Event($conditions, $request[0]);
        }
        return $event;
    }

    /**
     * @param Event $event
     * @return bool
     */
    public function deleteEvent(Event $event): bool
    {
        return EventRepository::deleteEvent($event);
    }

    /**
     * @return bool
     */
    public function deleteAllEvents(): bool
    {
        return EventRepository::deleteAllEvents();
    }

    /**
     * @return Collection
     */
    public function getAllEvents(): Collection
    {
        $collection = new Collection();
        $keys = EventRepository::getAllKeys();
        foreach ($keys as $key) {
            $collection->addItem(
                $this->findEvent($key)
            );
        }
        return $collection;
    }

    /**
     * @param string $key
     * @return Event|null
     */
    public function findEvent(string $key): ?Event
    {
        $result = null;
        $savedEvent = EventRepository::findByKey($key);
        if ($savedEvent) {
            $result = new Event($key, $savedEvent[0]);
        }
        return $result;
    }
}
