<?php

namespace App\Http\Controllers;

use App\Services\Events\Event;
use App\Services\Events\EventService;
use Illuminate\Http\Request;


class EventAddController extends Controller
{
    private EventService $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function __invoke(Request $request){

        $textEvent = $request['textEvent'];
        if (!empty($textEvent)) {
            $this->eventService->addEvent($textEvent);
            flash('События добавлены')->important()->success();
        } else {
            flash('Пустой запрос')->important()->warning();
        }
        return view('home', []);
    }




}
