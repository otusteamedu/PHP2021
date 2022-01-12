<?php

declare(strict_types=1);

namespace App\Modules\Event\Application\Services;

use App\Modules\Event\Application\Constants\EventConstants;
use App\Modules\Event\Application\Contracts\EventRedisRepositoryInterface;
use App\Modules\Event\Application\Contracts\EventServiceInterface;
use App\Modules\Event\Domain\DTO\CreateEventDTO;
use App\Modules\Event\Domain\DTO\SearchEventDTO;

class EventService implements EventServiceInterface
{
    private EventRedisRepositoryInterface $eventRepository;

    public function __construct(EventRedisRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function createEvent(CreateEventDTO $eventDto): void
    {
        $newEventId = $this->getNewEventId();
        $this->addPriority($newEventId, $eventDto->getPriority());
        $this->addParams($newEventId, $eventDto->getParams());
        $this->addEvents($newEventId, $eventDto->getEvents());
    }

    public function getEventByParams(SearchEventDTO $eventDto): array
    {
        $events = collect([]);

        foreach ($eventDto->getParams() as $key => $value) {
            $events->push($this->eventRepository->getEventsPyParam("$key:$value"));
        }

        $maxPriority = 0;
        $event = '';

        foreach ($events->collapse()->toArray() as $eventId) {
            $key = "event:$eventId";
            $eventProperty = $this->eventRepository->getEventPriority($key);

            if ($eventProperty > $maxPriority) {
                $maxPriority = $eventProperty;
                $event = $key;
            }
        }

        return $this->eventRepository->getEventsByName($event);
    }

    private function getNewEventId(): int
    {
        $lastEventId = (int) $this->eventRepository->getLastEventId();

        if (!$lastEventId) {
            $lastEventId = EventConstants::FIRS_EVENT_ID;
            $this->eventRepository->addEventId('last:event:id', $lastEventId);
        } else {
            $lastEventId++;
            $this->eventRepository->incrEventId();
        }

        return $lastEventId;
    }

    private function addPriority(int $eventId, int $priority): void
    {
        $this->eventRepository->createEventPriority("event:$eventId", $priority);
    }

    private function addParams(int $eventId, array $params): void
    {
        foreach ($params as $key => $value) {
            $this->eventRepository->createEventParam("$key:$value", $eventId);
        }
    }

    private function addEvents(int $eventId, array $events): void
    {
        foreach ($events as $value) {
            $this->eventRepository->createEventEvent("event:$eventId", $value);
        }
    }
}
