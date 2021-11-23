<?php

namespace App\Services\Events\Repositories;

use App\Services\Events\Event;
use Illuminate\Support\Facades\Redis;

class RedisEventRepository implements EventRepository
{

    public function addEvent(Event $event)
    {
        $add = Redis::zadd($event->getCondition(), $event->getPriority(), $event->getEvent());
        return $add > 0;
    }

    public function clearEvents()
    {
        Redis::flushAll();
    }

    public function getEvent(string $key)
    {
       $event = Redis::zpopmax($key);
       Redis::zadd($key, $event);
       return $event;
    }
}