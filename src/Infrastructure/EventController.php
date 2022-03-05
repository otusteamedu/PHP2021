<?php

namespace App\Infrastructure;

use App\Application\EventControllerInterface;
use App\Application\EventRepositoryInterface;
use App\Domain\Event;
use App\DTO\Response;
use Exception;

class EventController implements EventControllerInterface
{
    private EventRepositoryInterface $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function get(): Response
    {
        $conditions = array_filter(
            $_GET,
            fn($key) => strpos($key, 'param') !== false,
            ARRAY_FILTER_USE_KEY
        );
        $event = $this->eventRepository->findEventByConditions($conditions);
        if ($event === null) {
            return new Response('event is not found', 200);
        }

        return new Response($event->getEvent(), 200);
    }

    /**
     * @throws Exception
     */
    public function create(): Response
    {
        $body = json_decode(file_get_contents('php://input'), true) ?? [];
        $event = new Event(
            $body['event'] ?? null,
            $body['conditions'] ?? [],
            $body['priority'] ?? null
        );
        if (!$event->isValid()) {
            throw new Exception('event is not valid');
        }
        $this->eventRepository->createEvent($event);

        return new Response('event successfully created', 201);
    }

    public function delete(): Response
    {
        $this->eventRepository->clearAllEvents();

        return new Response('', 204);
    }
}
