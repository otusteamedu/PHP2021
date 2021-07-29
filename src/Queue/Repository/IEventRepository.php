<?php


namespace Queue\Events\Repository;

interface IEventRepository
{
    /**
     * Вставляем событие в очередь событий.
     * @return mixed
     */
    public function add(int $priority, array $conditions, array $event);

    /**
     * Возвращаем самое приоритетное событие.
     * @return array|null
     */
    public function findHighPriorityEvent($conditions): ?array;

    /**
     * Получаем срез по ивентам.
     * @return mixed
     */
    public function findAllEvent($conditions): array;

    /**
     *
     * Удаляет все данные.
     * @return mixed
     */
    public function flush();
}