<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 06.12.2021
 * Time: 17:49
 */

namespace app\services;

use app\providers\ESProvider;

/**
 * Class StatisticService
 * @package app\services
 */
class StatisticService
{
    /**
     * @var ESProvider
     */
    private ESProvider $esProvider;

    /**
     * StatisticService constructor.
     * @param ESProvider $esProvider
     */
    public function __construct(ESProvider $esProvider)
    {
        $this->esProvider = $esProvider;
    }

    public function likes(string $channelId)
    {
        $this
            ->esProvider
            ->search($channelId);
    }
}