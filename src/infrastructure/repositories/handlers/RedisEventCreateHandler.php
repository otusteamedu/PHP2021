<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 23.02.2022
 * Time: 15:29
 */

namespace app\infrastructure\repositories\handlers;

use app\domain\DTO\EventDTO;
use app\infrastructure\helpers\RedisEventHelper;
use Redis;

/**
 * Добавление события в Redis
 *
 * Class RedisEventCreateHandler
 * @package app\infrastructure\repositories\handlers
 */
class RedisEventCreateHandler
{
    /**
     * @var Redis
     */
    private Redis $redis;

    /**
     * Событие для добавления
     *
     * @var EventDTO
     */
    private EventDTO $event;

    /**
     * @param Redis $redis
     * @param EventDTO $event
     */
    public function __construct(Redis $redis, EventDTO $event)
    {
        $this->redis = $redis;
        $this->event = $event;
    }

    /**
     * Добавление записей
     *
     * @return void
     */
    public function run()
    {
        $this->insertData();
        $this->insertParams();
        $this->addPriority();
    }

    /**
     * Добавление данных события
     *
     * @return void
     */
    private function insertData()
    {
        $event = $this->event;
        $redis = $this->redis;
        $key = RedisEventHelper::getDataKey($event->getName());

        $redis->hMSet($key, [
            'name' => $event->getName(),
            'priority' => $event->getPriority(),
        ]);
    }

    /**
     * Добавление параметров события
     *
     * @return void
     */
    private function insertParams()
    {
        $event = $this->event;
        $redis = $this->redis;
        $key = RedisEventHelper::getParamsKey($event->getName());

        $redis->hMSet($key, $event->getParams());
    }

    /**
     * Добавление приоритета
     *
     * @return void
     */
    private function addPriority()
    {
        $event = $this->event;
        $redis = $this->redis;
        $key = RedisEventHelper::getPriorityKey();

        $redis->zAdd($key, $event->getPriority(), $event->getName());
    }
}
