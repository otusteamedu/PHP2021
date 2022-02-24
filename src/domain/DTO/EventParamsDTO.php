<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 24.02.2022
 * Time: 9:53
 */

namespace app\domain\DTO;

use Exception;

/**
 * Параметры события
 *
 * Class EventTriggerDTO
 * @package app\domain\DTO
 */
class EventParamsDTO
{
    /**
     * Параметры
     *
     * @var array
     */
    private array $params;

    /**
     * @param array $params
     * @throws Exception
     */
    public function __construct(array $params)
    {
        self::assertConditions($params);
        $this->params = $params;
    }

    /**
     * Проверка параметров
     *
     * @throws Exception
     */
    private static function assertConditions(array $data)
    {
        if (empty($data) === true) {
            throw new Exception("Params can not to be empty");
        }
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
