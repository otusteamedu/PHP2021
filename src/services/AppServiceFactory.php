<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 10.02.2022
 * Time: 16:13
 */

namespace app\services;

use app\repositories\source\YoutubeSourceRepository;
use app\repositories\store\ElasticSearchStoreRepository;

/**
 * Создание сервиса приложения
 *
 * Class AppServiceFactory
 * @package app\services
 */
class AppServiceFactory
{
    /**
     * Создание базового сервиса
     *
     * @return AppService
     */
    public static function create(): AppService
    {
        return new AppService(
            ElasticSearchStoreRepository::create(),
            YoutubeSourceRepository::create(),
        );
    }
}
