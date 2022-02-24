<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 21.02.2022
 * Time: 17:36
 */

namespace app\infrastructure\helpers;


/**
 * Хелпер событий
 *
 * Class EventHelper
 * @package app\infrastructure\helpers
 */
class EventHelper
{
    /**
     * Преобразование строки вида param1=1,param2=2... массив
     *
     * @param string $value
     * @return array
     */
    public static function conditionsToArray(string $value): array
    {
        $result = [];
        $params = explode(',', $value);

        foreach ($params as $param) {
            list($key, $value) = explode('=', $param);
            $result[$key] = $value;
        }

        return $result;
    }
}
