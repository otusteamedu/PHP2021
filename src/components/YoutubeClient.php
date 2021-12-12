<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 16:35
 */

namespace app\components;

use Google\Service\YouTube\ChannelListResponse;
use Google\Service\YouTube\SearchListResponse;
use Google\Service\YouTube\VideoListResponse;
use Google_Client;
use Google_Service_YouTube;

/**
 * Клиент работы с Youtube
 */
class YoutubeClient
{
    /**
     * @var Google_Service_YouTube
     */
    private Google_Service_YouTube $youtube;

    /**
     * YoutubeProvider constructor.
     */
    public function __construct()
    {
        $apiKey = 'AIzaSyBz7TK-7cDKqeTlj78C4Mkt8jKpbmxL_cA';

        $client = new Google_Client();
        $client->setDeveloperKey($apiKey);

        $this->youtube = new Google_Service_YouTube($client);
    }

    /**
     * Получает информацию о каналах
     * @param array|string $part
     * @param array $params
     * @return ChannelListResponse
     */
    public function channels($part, $params = []): ChannelListResponse
    {
        return $this
            ->youtube
            ->channels
            ->listChannels($part, $params);
    }

    /**
     * Получает информацию о каналах
     * @param array|string $part
     * @param array $params
     * @return SearchListResponse
     */
    public function search($part, $params = []): SearchListResponse
    {
        return $this
            ->youtube
            ->search
            ->listSearch($part, $params);
    }

    /**
     * Получает информацию о каналах
     * @param array|string $part
     * @param array $params
     * @return VideoListResponse
     */
    public function videos($part, $params = []): VideoListResponse
    {
        return $this
            ->youtube
            ->videos
            ->listVideos($part, $params);
    }
}