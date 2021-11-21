<?php

namespace App\Services\Events\Repositories;

use App\Services\Events\Event;

interface EventRepository
{
    public function addEvent(Event $event);

    public function clearEvents();

    public function getEvent(array $request);

}