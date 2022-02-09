<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 16:15
 */

namespace app\models\youtube;


/**
 * Модель видео с Youtube
 *
 * Class YoutubeVideoModel
 * @package app\models\youtube
 */
class YoutubeVideoModel
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $title;

    /**
     * ID канала
     *
     * @var string
     */
    private string $channelId;

    /**
     * Количество лайков
     *
     * @var int
     */
    private int $likeCount = 0;

    /**
     * Количество диз лайков
     *
     * @var int
     */
    private int $dislikeCount = 0;

    /**
     * ChannelModel constructor.
     * @param string $id
     * @param string $title
     * @param string $channelId
     */
    public function __construct(string $id, string $title, string $channelId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->channelId = $channelId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getChannelId(): string
    {
        return $this->channelId;
    }

    /**
     * @return int
     */
    public function getLikeCount(): int
    {
        return $this->likeCount;
    }

    /**
     * @param int $likeCount
     * @return YoutubeVideoModel
     */
    public function setLikeCount(int $likeCount): YoutubeVideoModel
    {
        $this->likeCount = $likeCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getDislikeCount(): int
    {
        return $this->dislikeCount;
    }

    /**
     * @param int $dislikeCount
     * @return YoutubeVideoModel
     */
    public function setDislikeCount(int $dislikeCount): YoutubeVideoModel
    {
        $this->dislikeCount = $dislikeCount;

        return $this;
    }
}
