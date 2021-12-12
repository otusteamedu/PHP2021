<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 07.11.2021
 * Time: 13:14
 */

namespace app;

use app\providers\ESProvider;
use app\providers\YoutubeProvider;
use app\services\ElasticSearchService;
use app\services\StatisticService;

/**
 * Class App
 * @package app
 */
class App
{
    /**
     *
     */
    public function run()
    {
//        $service = new ElasticSearchService(
//            new YoutubeProvider(),
//            new ESProvider()
//        );
//
//        $service->indexVideos('UCixlrqz8w-oa4UzdKyHLMaA');

        $service = new StatisticService(
            new ESProvider()
        );

        $service->likes('UCixlrqz8w-oa4UzdKyHLMaA');
    }
}
