<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 04.12.2021
 * Time: 20:38
 */

namespace app\providers;

use app\components\YoutubeClient;
use app\mappers\YoutubeModelMapper;
use app\models\ChannelModel;
use app\models\VideoModel;
use Google\Service\YouTube\SearchResult;
use Google\Service\YouTube\Video;

/**
 * Class YoutubeProvider
 * @package app\providers
 */
class YoutubeProvider
{
    /**
     * @var YoutubeClient
     */
    private YoutubeClient $youtubeClient;

    /**
     * YoutubeProvider constructor.
     */
    public function __construct()
    {
        $this->youtubeClient = new YoutubeClient();
    }

    /**
     * Получает информацию о канале по id
     * @param string $id
     * @return ChannelModel|null
     */
    public function channelById(string $id): ?ChannelModel
    {
        $result = $this
            ->youtubeClient
            ->channels('snippet,statistics', [
                'id' => $id,
            ]);

        if (empty($result->getItems()) === true) {
            return null;
        }

        $channel = current($result->getItems());

        return YoutubeModelMapper::channelToModel($channel);
    }

    /**
     * Получает список видео по id канала
     * @param string $id
     * @return VideoModel[]
     */
    public function videosByChannelId(string $id): array
    {
        $videosId = $this->searchVideosByChannelId($id);

        $result = $this
            ->youtubeClient
            ->videos('snippet,statistics', [
                'id' => implode(',', $videosId),
            ]);

        $items = $result->getItems();

        return array_map(function (Video $item) {
            return YoutubeModelMapper::videoToModel($item);
        }, $items);
    }

    /**
     * Поиск список видео по id канала
     * @param string $id
     * @return string[]
     */
    public function searchVideosByChannelId(string $id): array
    {
        $result = $this
            ->youtubeClient
            ->search('id', [
                'channelId' => $id,
            ]);

        $items = $result->getItems();

        return array_map(function (SearchResult $item) {
            return $item
                ->getId()
                ->getVideoId();
        }, $items);
    }
}
