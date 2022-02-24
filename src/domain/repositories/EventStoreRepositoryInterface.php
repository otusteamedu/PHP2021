<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 21.02.2022
 * Time: 17:46
 */

namespace app\domain\repositories;

use app\domain\DTO\EventDTO;
use app\domain\DTO\EventParamsDTO;

/**
 * Репозиторий хранения данных
 *
 * Class EventStoreRepositoryInterface
 * @package app\domain\repositories
 */
interface EventStoreRepositoryInterface
{
    /**
     * Добавление данных
     *
     * @param EventDTO $event
     * @return void
     */
    public function createEvent(EventDTO $event): void;

    /**
     * Удаление всех событий
     *
     * @return void
     */
    public function cleanEvents(): void;

    /**
     * Поиск события по параметрам
     *
     * @param EventParamsDTO $params
     * @return EventDTO|null
     */
    public function findEventByParams(EventParamsDTO $params): ?EventDTO;
}
