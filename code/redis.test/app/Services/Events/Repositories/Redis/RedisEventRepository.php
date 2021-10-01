<?php

declare(strict_types=1);

namespace App\Services\Events\Repositories\Redis;

use App\Services\Events\DTO\EventDTO;
use App\Services\Events\Repositories\EventRepository;
use Illuminate\Redis\Connections\Connection;
use Redis;

final class RedisEventRepository implements EventRepository
{

    private const EVENTS_PREFIX = "events:";

    private Redis $redis;

    private RedisEventRepositoryFormater $redisEventRepositoryFormater;

    /**
     * @param Connection $redisConnection
     */
    public function __construct(Connection $redisConnection, RedisEventRepositoryFormater $redisEventRepositoryFormater)
    {
        $this->redis = $redisConnection->client();
        $this->redisEventRepositoryFormater = $redisEventRepositoryFormater;
    }

    public function add(EventDTO $eventDTO): bool
    {
        $params = $this->redisEventRepositoryFormater->getDataToAddEvent($eventDTO);
        $added = $this->redis->zAdd(
            self::EVENTS_PREFIX . $params->getKey(),
            $params->getOptions(),
            $params->getScore()
        );
        return $added > 0;
    }

    public function clear(): bool
    {
        return $this->redis->flushAll();
    }

    public function getAllConditions(): array
    {
        return $this->redis->keys(self::EVENTS_PREFIX . '*');
    }

    public function getEvents(array $conditions): array
    {
        $result = [];
        foreach ($conditions as $condition) {
            $result[$condition] = $this->redis->zRevRange($condition, 0, -1, true);
        }
        return $result;
    }

    public function findEventByConditions(array $conditions): ?string
    {
        $result = [];
        foreach ($conditions as $condition) {
            $event = $this->redis->zRevRange(self::EVENTS_PREFIX . $condition, 0, 0, true);
            if (!empty($event)) {
                $result = array_merge($result, $event);
            }
        }
        if (empty($result)) {
            return null;
        }
        arsort($result);
        return array_key_first($result);
    }
}
