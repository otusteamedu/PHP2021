<?php

namespace App\Http\Controllers;

use App\Services\Events\Common\ViewService;
use App\Services\Events\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private EventService $eventService;

    private ViewService $viewService;

    public function __construct(EventService $eventService, ViewService $viewService)
    {
        $this->eventService = $eventService;
        $this->viewService = $viewService;
    }

    public function add(Request $request)
    {
        $params = $request->post();
        $result = $this->eventService->addEvent($params);
        $this->viewService->booleanAnswer($result);
    }

    public function get(Request $request)
    {
        $params = $request->getContent();
        $result = $this->eventService->findEventByParams(json_decode($params, true));
        $this->viewService->printValue($result);
    }

    public function getAllEvents()
    {
        $events = $this->eventService->getAllEvents();
        $this->viewService->printArray($events);
    }

    public function getAllConditions()
    {
        $result = $this->eventService->getAllConditions();
        $this->viewService->printArray($result);
    }

    public function deleteAll()
    {
        $result = $this->eventService->clearData();
        $this->viewService->booleanAnswer($result);
    }

}
