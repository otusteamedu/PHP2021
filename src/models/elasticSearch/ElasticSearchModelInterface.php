<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.02.2022
 * Time: 14:15
 */

namespace app\models\elasticSearch;

/**
 * Интерфейс модели ElasticSearch
 *
 * Class ElasticSearchModelInterface
 * @package app\models\elasticSearch
 */
interface ElasticSearchModelInterface
{
    /**
     * Параметры для индекса
     *
     * @return array
     */
    public function getIndexParams(): array;
}