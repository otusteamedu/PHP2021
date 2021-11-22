<?php

namespace App\Http\Controllers;

use App\Services\Events\Event;
use App\Services\Events\EventService;
use Illuminate\Http\Request;


class EventClearController extends Controller
{
    private EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function __invoke(Request $request)
    {
        $this->eventService->clear();
        flash('Все события удалены')->important()->error();
        return view('home', []);
    }


}
