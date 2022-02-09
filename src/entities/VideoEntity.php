<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.02.2022
 * Time: 11:32
 */

namespace app\entities;

/**
 * Сущность видео
 *
 * Class VideoEntity
 * @package entities
 */
class VideoEntity
{
    /**
     * ID видео
     *
     * @var string
     */
    private string $id;

    /**
     * Название видео
     *
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $channelId;

    /**
     * @var int
     */
    private int $likeCount;

    /**
     * @var int
     */
    private int $dislikeCount;

    /**
     * @param string $id
     * @param string $title
     * @param string $channelId
     * @param int $likeCount
     * @param int $dislikeCount
     */
    public function __construct(
        string $id,
        string $title,
        string $channelId,
        int    $likeCount = 0,
        int    $dislikeCount = 0
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->channelId = $channelId;
        $this->likeCount = $likeCount;
        $this->dislikeCount = $dislikeCount;
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
     * @return int
     */
    public function getDislikeCount(): int
    {
        return $this->dislikeCount;
    }
}
