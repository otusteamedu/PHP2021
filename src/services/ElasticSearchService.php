<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 16:58
 */

namespace app\services;

use app\providers\ESProvider;
use app\providers\YoutubeProvider;
use Exception;

/**
 * Class ElasticSearchService
 * @package app\services
 */
class ElasticSearchService
{
    /**
     * @var YoutubeProvider
     */
    private YoutubeProvider $youtubeProvider;
    /**
     * @var ESProvider
     */
    private ESProvider $esProvider;

    /**
     * ChannelElasticSearchService constructor.
     * @param YoutubeProvider $youtubeProvider
     * @param ESProvider $esProvider
     */
    public function __construct(
        YoutubeProvider $youtubeProvider,
        ESProvider $esProvider
    )
    {
        $this->youtubeProvider = $youtubeProvider;
        $this->esProvider = $esProvider;
    }

    /**
     * Добавление канала в индекс
     * @param string $channelId
     * @throws Exception
     */
    public function indexChannel(string $channelId)
    {
        $channel = $this
            ->youtubeProvider
            ->channelById($channelId);

        if ($channel === null) {
            throw new Exception("Канал $channelId не найден");
        }

        $this
            ->esProvider
            ->indexChannel($channel);
    }

    /**
     * Добавление списка видео канала в индекс
     * @param string $channelId
     * @throws Exception
     */
    public function indexVideos(string $channelId)
    {
        $videos = $this
            ->youtubeProvider
            ->videosByChannelId($channelId);

        if (empty($videos) === true) {
            throw new Exception("Нет видео на канале $channelId");
        }

        $this
            ->esProvider
            ->indexVideos($videos);
    }
}