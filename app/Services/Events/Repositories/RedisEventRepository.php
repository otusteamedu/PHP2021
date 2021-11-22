<?php

namespace App\Services\Events\Repositories;

use App\Services\Events\Event;
use Illuminate\Support\Facades\Redis;

class RedisEventRepository implements EventRepository
{

    public function addEvent(Event $event)
    {
        Redis::set('name', 'Taylor');
    }

    public function clearEvents()
    {
        Redis::flushAll();
    }

    public function getEvent(array $request)
    {
        return Redis::get('name');
    }
}