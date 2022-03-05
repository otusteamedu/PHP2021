<?php

namespace App\Infrastructure;

use App\Application\EventRepositoryInterface;
use App\Domain\Event;
use Redis;

class EventRepository implements EventRepositoryInterface
{
    private const PREFIX = 'event:';
    private const DATA_PREFIX = 'event:data:';
    private const CONDITIONS_PREFIX = 'event:conditions:';
    private const PRIORITY_PREFIX = 'event:priority';

    private Redis $client;

    public function __construct(Redis $client)
    {
        $this->client = $client;
        $client->connect(getenv('LOCAL_HOST'), getenv('REDIS_PORT'));
    }

    public function findEventByConditions(array $conditions): ?Event
    {
        $priorityKeys =
            $this->client->zRevRange(self::PRIORITY_PREFIX, 0, -1, true);

        return $this->getEvent($priorityKeys, $conditions);
    }

    public function createEvent(Event $event): string
    {
        $id = uniqid();
        $pipe = $this->client->pipeline();
        $pipe->set(self::DATA_PREFIX . $id, $event->getEvent());
        $pipe->hMSet(self::CONDITIONS_PREFIX . $id, $event->getConditions());
        $pipe->zAdd(self::PRIORITY_PREFIX, $event->getPriority(), $id);
        $pipe->exec();

        return $id;
    }

    public function clearAllEvents(): void
    {
        $keys = $this->client->keys(self::PREFIX . '*');
        $this->client->del($keys);
    }

    private function getEvent(array $priorityKeys, array $conditions): ?Event
    {
        foreach ($priorityKeys as $key => $priority) {
            $dataKey = self::DATA_PREFIX . $key;
            $conditionKey = self::CONDITIONS_PREFIX . $key;

            $paramSet = $this->client->hMGet(
                $conditionKey,
                array_keys($conditions)
            );
            $diff = array_diff_assoc($paramSet, $conditions);
            $existedParams = array_filter($diff, fn($v) => $v !== false);
            if (count($diff) < count($paramSet)
                && count($existedParams) === 0
            ) {
                $data = $this->client->get($dataKey);
                $conditions = $this->client->hGetAll($conditionKey);

                return new Event($data, $conditions, $priority);
            }
        }

        return null;
    }
}
