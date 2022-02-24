<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 21.02.2022
 * Time: 17:28
 */

namespace app\infrastructure\commands;

use app\domain\DTO\EventDTO;
use app\domain\DTO\EventParamsDTO;
use app\infrastructure\repositories\RedisEventStoreRepository;
use app\application\services\EventServiceInterface;
use app\infrastructure\helpers\EventHelper;
use app\infrastructure\services\EventService;
use Exception;
use Throwable;

/**
 * Управление события из командной строки
 *
 * Class EventCommand
 * @package app\infrastructure\commands
 */
class EventCommand
{
    /**
     * Сервис событий
     *
     * @var EventServiceInterface|EventService
     */
    private EventServiceInterface $eventService;

    /**
     *
     */
    public function __construct()
    {
        $redisRepository = new RedisEventStoreRepository();
        $this->eventService = new EventService($redisRepository);
    }

    /**
     * Добавление события
     *
     * @param string $eventName
     * @param int $priority
     * @param string $conditions
     * @return void
     * @throws Exception
     */
    public function create(string $eventName, int $priority, string $conditions)
    {
        $conditionList = EventHelper::conditionsToArray($conditions);

        $eventName = new EventDTO(
            $eventName,
            $priority,
            new EventParamsDTO($conditionList)
        );

        $this
            ->eventService
            ->create($eventName);
    }

    /**
     * Удаление всех событий
     *
     * @return void
     */
    public function clear()
    {
        $this
            ->eventService
            ->clear();
    }

    /**
     * Вызов события
     *
     * @return void
     * @throws Exception
     */
    public function trigger(string $params)
    {
        $conditionList = EventHelper::conditionsToArray($params);
        $eventParams = new EventParamsDTO($conditionList);

        try {
            $event = $this
                ->eventService
                ->trigger($eventParams);

            echo $event->getName() . PHP_EOL;
        } catch (Throwable $exception) {
            echo $exception->getMessage() . PHP_EOL;
        }
    }
}
