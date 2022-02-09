<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.02.2022
 * Time: 11:32
 */

namespace app\entities;

/**
 * Лучший канал для статистики
 *
 * Class LikeStatisticEntity
 * @package entities
 */
class BestChannelsStatisticEntity
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
     * @param string $channelId
     * @param int $likeCount
     */
    public function __construct(
        string $channelId,
        int    $likeCount
    )
    {
        $this->channelId = $channelId;
        $this->likeCount = $likeCount;
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
}
