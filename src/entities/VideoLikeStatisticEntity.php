<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.02.2022
 * Time: 11:32
 */

namespace app\entities;

/**
 * Канал для статистики лучшего канала
 *
 * Class LikeStatisticEntity
 * @package entities
 */
class VideoLikeStatisticEntity
{
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
     * @param string $channelId
     * @param int $likeCount
     * @param int $dislikeCount
     */
    public function __construct(
        string $channelId,
        int    $likeCount,
        int    $dislikeCount
    )
    {
        $this->channelId = $channelId;
        $this->likeCount = $likeCount;
        $this->dislikeCount = $dislikeCount;
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
