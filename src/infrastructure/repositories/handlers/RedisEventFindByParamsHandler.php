<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 24.02.2022
 * Time: 11:32
 */

namespace app\infrastructure\repositories\handlers;

use app\domain\DTO\EventDTO;
use app\domain\DTO\EventParamsDTO;
use app\infrastructure\helpers\RedisEventHelper;
use app\infrastructure\repositories\RedisEventStoreRepository;
use Exception;
use Redis;

/**
 * Поиск события по параметрам
 *
 * Class RedisEventFindByParamsHandler
 * @package app\infrastructure\repositories\handlers
 */
class RedisEventFindByParamsHandler
{
    /**
     * Экземпляр Redis
     *
     * @var Redis
     */
    private Redis $redis;

    /**
     * Параметры поиска
     *
     * @var EventParamsDTO
     */
    private EventParamsDTO $params;

    /**
     * @param Redis $redis
     * @param EventParamsDTO $params
     */
    public function __construct(Redis $redis, EventParamsDTO $params)
    {
        $this->redis = $redis;
        $this->params = $params;
    }

    /**
     * Получение события
     *
     * @return EventDTO|null
     * @throws Exception
     */
    public function run(): ?EventDTO
    {
        $priorities = $this->getPriorityEvents();

        foreach ($priorities as $eventKey) {
            $isValid = $this->isValidParams($eventKey);

            if ($isValid === true) {
                return $this->getEvent($eventKey);
            }
        }

        return null;
    }

    /**
     * Получение списка приоритетов событий
     *
     * @return array
     */
    private function getPriorityEvents(): array
    {
        $redis = $this->redis;
        $key = RedisEventHelper::getPriorityKey();

        return $redis->zRevRange($key, 0, -1);
    }

    /**
     * Проверка параметров поиска
     *
     * @param string $eventKey
     * @return bool
     */
    private function isValidParams(string $eventKey): bool
    {
        $eventParams = $this->getEventParams($eventKey);
        $searchParams = $this
            ->params
            ->getParams();

        $resultArray = array_intersect_assoc($searchParams, $eventParams);

        return empty($resultArray) === false;
    }

    /**
     * Список параметров события
     *
     * @param string $eventKey
     * @return array
     */
    private function getEventParams(string $eventKey): array
    {
        $redis = $this->redis;
        $key = RedisEventHelper::getParamsKey($eventKey);

        return $redis->hGetAll($key);
    }

    /**
     * Список данных события
     *
     * @param string $eventKey
     * @return array
     */
    private function getEventData(string $eventKey): array
    {
        $redis = $this->redis;
        $key = RedisEventHelper::getDataKey($eventKey);

        return $redis->hGetAll($key);
    }

    /**
     * Получение события
     *
     * @param string $eventKey
     * @return EventDTO
     * @throws Exception
     */
    private function getEvent(string $eventKey): EventDTO
    {
        $data = $this->getEventData($eventKey);
        $params = $this->getEventParams($eventKey);

        return new EventDTO(
            $data['name'],
            (int)$data['priority'],
            new EventParamsDTO($params)
        );
    }
}
