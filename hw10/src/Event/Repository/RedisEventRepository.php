<?php

namespace App\Event\Repository;

use App\Event\EventRepositoryInterface;

class RedisEventRepository implements EventRepositoryInterface
{
    public function __construct(
        private \Redis $redis
    ){
    }

    public function add(array $conditions, array $event, int $priority = 0)
    {
        $key = $this->keyFromConditions($conditions);

        $this->redis->zAdd($key, $priority, $event);
    }

    public function findOneWithHighestPriorityByConditions(array $conditions): ?array
    {
        $key = $this->keyFromConditions($conditions);

        $event = $this->redis->zRevRange($key, 0, 0);
        if (empty($event)) {
            return null;
        }

        return $event[0];
    }

    public function findAllByConditions(array $conditions): array
    {
        $key = $this->keyFromConditions($conditions);

        return $this->redis->zRange($key, 0, -1);
    }

    public function deleteAllEventsByConditions(array $conditions): int
    {
        $key = $this->keyFromConditions($conditions);

        return $this->redis->del($key);
    }

    public function deleteOneEvent(array $conditions, array $event): int
    {
        $key = $this->keyFromConditions($conditions);

        return $this->redis->zRem($key, $event);
    }

    public function flush()
    {
        $this->redis->flushAll();
    }

    private function keyFromConditions(array $conditions): string
    {
        if (empty($conditions) === true) {
            return '';
        }

        ksort($conditions);

        $keys = [];

        foreach ($conditions as $key => $val) {
            $keys[] = "$key=$val";
        }

        return implode(':', $keys);
    }
}
