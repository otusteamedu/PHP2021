<?php

namespace App\Http\Controllers;

use App\Services\Events\Event;
use App\Services\Events\EventService;
use Illuminate\Http\Request;


class EventFindController extends Controller
{
    private EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function __invoke(Request $request)
    {
        $findEvent = $request['findEvent'];
        if (!empty($findEvent)) {
           $event = $this->eventService->findEvent($findEvent);

            flash('Подобраны следующие события:'.$event)->important();

        } else {
            flash('Пустой запрос')->important()->warning();
        }
        return view('home', []);
    }


}
