<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 04.12.2021
 * Time: 20:38
 */

namespace app\adapters;

use app\helpers\ConfigHelper;
use app\models\youtube\YoutubeChannelModel;
use app\models\youtube\YoutubeVideoModel;
use Google\Service\YouTube\Channel;
use Google\Service\YouTube\SearchResult;
use Google\Service\YouTube\Video;
use Google_Client;
use Google_Service_YouTube as YouTubeClient;

/**
 * Адаптер YouTube
 *
 * Class YoutubeAdapter
 * @package app\adapters
 */
class YoutubeAdapter
{
    /**
     * Клиент данных - Youtube
     *
     * @var YouTubeClient
     */
    private YouTubeClient $youTubeClient;

    /**
     * YoutubeProvider constructor.
     */
    public function __construct()
    {
        $config = new ConfigHelper();

        $client = new Google_Client();
        $client->setDeveloperKey($config->getYoutubeApiKey());

        $this->youTubeClient = new YouTubeClient($client);
    }

    /**
     * Получает информацию о канале по ID
     *
     * @param string $id
     *
     * @return YoutubeChannelModel|null
     */
    public function channelById(string $id): ?YoutubeChannelModel
    {
        $result = $this
            ->youTubeClient
            ->channels
            ->listChannels('snippet', [
                'id' => $id,
            ]);

        if (empty($result->getItems()) === true) {
            return null;
        }

        /** @var Channel $channel */
        $channel = current($result->getItems());

        return new YoutubeChannelModel(
            $channel->id,
            $channel
                ->getSnippet()
                ->getTitle()
        );
    }

    /**
     * Получение ID списка видео по ID канала
     *
     * @param string $id
     *
     * @return string[]
     */
    public function videoIdsByChannelId(string $id): array
    {
        $result = $this
            ->youTubeClient
            ->search
            ->listSearch('id', [
                'channelId' => $id,
            ]);

        return array_map(
            static function (SearchResult $item) {
                return $item
                    ->getId()
                    ->getVideoId();
            },
            $result->getItems()
        );
    }

    /**
     * Получение списка видео по ID
     *
     * @param string[] $ids
     *
     * @return YoutubeVideoModel[]
     */
    public function videoListByIds(array $ids): array
    {
        $result = $this
            ->youTubeClient
            ->videos
            ->listVideos('snippet,statistics', [
                'id' => implode(',', $ids),
            ]);

        return array_map(
            static function (Video $item) {
                $snippet = $item->getSnippet();
                $statistics = $item->getStatistics();

                $model = new YoutubeVideoModel(
                    $item->getId(),
                    $snippet->getTitle(),
                    $snippet->getChannelId(),
                );

                return $model
                    ->setLikeCount($statistics->getLikeCount() ?? 0)
                    ->setDislikeCount($statistics->getDislikeCount() ?? 0);
            },
            $result->getItems()
        );
    }
}
