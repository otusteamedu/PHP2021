<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 21.02.2022
 * Time: 17:21
 */

namespace app\domain\DTO;

/**
 * Данные события
 *
 * Class EventDTO
 * @package app\domain\DTO
 */
class EventDTO
{
    /**
     * Название события
     *
     * @var string
     */
    private string $name;

    /**
     * Приоритет
     *
     * @var int
     */
    private int $priority;

    /**
     * Условия
     *
     * @var EventParamsDTO
     */
    private EventParamsDTO $params;

    /**
     * @param string $name
     * @param int $priority
     * @param EventParamsDTO $params
     */
    public function __construct(
        string         $name,
        int            $priority,
        EventParamsDTO $params
    )
    {

        $this->name = $name;
        $this->priority = $priority;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this
            ->params
            ->getParams();
    }
}
