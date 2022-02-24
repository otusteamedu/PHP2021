<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 21.02.2022
 * Time: 17:31
 */

namespace app\infrastructure\services;

use app\domain\DTO\EventDTO;
use app\application\services\EventServiceInterface;
use app\domain\DTO\EventParamsDTO;
use app\domain\repositories\EventStoreRepositoryInterface;
use Exception;

/**
 * Управление событиями
 *
 * Class EventService
 * @package app\infrastructure\services
 */
class EventService implements EventServiceInterface
{
    /**
     * Репозиторий хранения данных
     *
     * @var EventStoreRepositoryInterface
     */
    private EventStoreRepositoryInterface $storeRepository;

    /**
     * @param EventStoreRepositoryInterface $storeRepository
     */
    public function __construct(EventStoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    /**
     * @inheritDoc
     */
    public function create(EventDTO $event): void
    {
        $this
            ->storeRepository
            ->createEvent($event);
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        $this
            ->storeRepository
            ->cleanEvents();
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function trigger(EventParamsDTO $params): EventDTO
    {
       $event = $this
            ->storeRepository
            ->findEventByParams($params);

       if ($event === null) {
           throw new Exception('Event not found');
       }

       return $event;
    }
}
