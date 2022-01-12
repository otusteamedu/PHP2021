<?php

declare(strict_types=1);

namespace App\Modules\Event\Infrastructure\Repositories;

use App\Modules\Event\Application\Contracts\EventRedisRepositoryInterface;
use Illuminate\Support\Facades\Redis;

class RedisRepository implements EventRedisRepositoryInterface
{
    public Redis $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public function createEventPriority(string $key, $value): void
    {
        $this->redis::command('zadd', ['events:priority', $value, $key]);
    }

    public function getEventsByName(string $key): array
    {
        return $this->redis::command('smembers', [$key]);
    }

    public function getLastEventId(string $key = 'last:event:id'): ?string
    {
        return $this->redis::command('get', [$key]);
    }

    public function incrEventId(string $key = 'last:event:id'): void
    {
        $this->redis::command('incr', [$key]);
    }

    public function getEventsPyParam(string $key): array
    {
        return $this->redis::command('smembers', [$key]);
    }

    public function getEventPriority(string $key): float
    {
        return $this->redis::command('zscore' , ['events:priority', $key]);
    }

    public function addEventId(string $key, int $id): void
    {
        $this->redis::command('set', [$key, $id]);
    }

    public function createEventParam(string $key, int $value): void
    {
        $this->redis::command('sadd', [$key, $value]);
    }

    public function createEventEvent(string $key, string $value): void
    {
        $this->redis::command('sadd', [$key, $value]);
    }
}
