<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 16:45
 */

namespace app\mappers;

use app\models\ChannelModel;
use app\models\VideoModel;
use Google\Service\YouTube\Channel;
use Google\Service\YouTube\Video;

/**
 * Class YoutubeModelMapper
 * @package app\mappers
 */
class YoutubeModelMapper
{
    /**
     * Преобразовывает канал с Youtube в модель
     * @param Channel $channel
     * @return ChannelModel
     */
    public static function channelToModel(Channel $channel): ChannelModel
    {
        return new ChannelModel([
            'id' => $channel->getId(),
            'title' => $channel
                ->getSnippet()
                ->getTitle(),
        ]);
    }

    /**
     * Преобразовывает видео с Youtube в модель
     * @param Video $video
     * @return VideoModel
     */
    public static function videoToModel(Video $video): VideoModel
    {
        return new VideoModel([
            'id' => $video->getId(),
            'title' => $video
                ->getSnippet()
                ->getTitle(),
            'channelId' => $video
                ->getSnippet()
                ->getChannelId(),
            'likeCount' => (int)$video
                ->getStatistics()
                ->getLikeCount(),
            'dislikeCount' => (int)$video
                ->getStatistics()
                ->getDislikeCount(),
        ]);
    }
}
