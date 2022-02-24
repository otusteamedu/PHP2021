<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 21.02.2022
 * Time: 17:32
 */

namespace app\application\services;

use app\domain\DTO\EventDTO;
use app\domain\DTO\EventParamsDTO;

/**
 * Управление событиями
 *
 * Class EventServiceInterface
 * @package app\application\services
 */
interface EventServiceInterface
{
    /**
     * Добавление события
     *
     * @param EventDTO $event
     * @return void
     */
    public function create(EventDTO $event): void;

    /**
     * Удаление всех событий
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Вызов события по параметрам
     *
     * @param EventParamsDTO $params
     * @return EventDTO
     */
    public function trigger(EventParamsDTO $params): EventDTO;
}
