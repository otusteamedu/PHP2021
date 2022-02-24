<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 21.02.2022
 * Time: 17:46
 */

namespace app\infrastructure\repositories;

use app\domain\DTO\EventDTO;
use app\domain\DTO\EventParamsDTO;
use app\domain\repositories\EventStoreRepositoryInterface;
use app\infrastructure\repositories\handlers\RedisEventFindByParamsHandler;
use app\infrastructure\singletons\RedisSingleton;
use app\infrastructure\repositories\handlers\RedisEventClearHandler;
use app\infrastructure\repositories\handlers\RedisEventCreateHandler;
use Exception;
use Redis;

/**
 * Redis в качестве хранилища
 *
 * Class RedisEventStoreRepository
 * @package app\infrastructure\repositories
 */
class RedisEventStoreRepository implements EventStoreRepositoryInterface
{
    /**
     * Redis соединение
     *
     * @var Redis
     */
    private Redis $redis;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->redis = RedisSingleton::instance();
    }

    /**
     * @inheritDoc
     */
    public function createEvent(EventDTO $event): void
    {
        $redis = $this->redis;

        $handler = new RedisEventCreateHandler($redis, $event);
        $handler->run();
    }

    /**
     * @inheritDoc
     */
    public function cleanEvents(): void
    {
        $redis = $this->redis;

        $handler = new RedisEventClearHandler($redis);
        $handler->run();
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function findEventByParams(EventParamsDTO $params): ?EventDTO
    {
        $redis = $this->redis;
        $handler = new RedisEventFindByParamsHandler($redis, $params);

        return $handler->run();
    }
}
