<?php

namespace App\Services\Events;

use App\Services\Events\Repositories\EventRepository;

class EventService
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function addEvent($request)
    {
        $arrEvent = json_decode($request);
        foreach ($arrEvent as $item) {
            foreach ($item->conditions as $param => $value) {
                $event = new Event($item->priority, $this->getCondition($param, $value), $item->event);
                $this->eventRepository->addEvent($event);
            }
        }
    }

    public function findEvent($request)
    {
        $conditions = json_decode($request);
        $results = [];
        $event = [];
        foreach ($conditions->params as $param => $value) {
            $event = $this->eventRepository->getEvent($this->getCondition($param, $value));
            $results[key($event)] = $event[key($event)];
        }
        return key($results);

    }

    public function clear()
    {
        $this->eventRepository->clearEvents();
    }


    private function getCondition($param, $value)
    {
        return $param . ':' . $value;
    }

}