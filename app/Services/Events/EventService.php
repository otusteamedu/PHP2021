<?php

namespace App\Services\Events;

use App\Services\Events\Repositories\EventRepository;

class EventService
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository){
        $this->eventRepository = $eventRepository;
    }

    public function addEvent($request){
        $this->eventRepository->addEvent(new Event(0,[],''));
    }

    public function findEvent(){
        return $this->eventRepository->getEvent([]);
    }

    public function clear(){
        $this->eventRepository->clearEvents();
    }

}