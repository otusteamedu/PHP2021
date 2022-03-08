<?php

namespace App\DTO;

class YoutubeChannelStats
{
    private string $channelId;
    private int $totalViews;
    private int $totalLikes;
    private ?float $likesToViewsPercentage;

    /**
     * @param string     $channelId
     * @param int        $totalViews
     * @param int        $totalLikes
     * @param float|null $likesToViewsPercentage
     */
    public function __construct(
        string $channelId,
        int $totalViews,
        int $totalLikes,
        ?float $likesToViewsPercentage = null
    ) {
        $this->channelId = $channelId;
        $this->totalViews = $totalViews;
        $this->totalLikes = $totalLikes;
        $this->likesToViewsPercentage = $likesToViewsPercentage;
    }

    public function __toString(): string
    {
        $str = sprintf(
            'channel_id: %s, total_views: %s, total_likes: %s',
            $this->channelId,
            $this->totalViews,
            $this->totalLikes
        );
        if ($this->likesToViewsPercentage !== null) {
            $str .= sprintf(
                ', likes_to _views_percentage: %s',
                $this->likesToViewsPercentage
            );
        }

        return $str;
    }

    public function getChannelId(): string
    {
        return $this->channelId;
    }

    public function getTotalViews(): int
    {
        return $this->totalViews;
    }

    public function getTotalLikes(): int
    {
        return $this->totalLikes;
    }

    public function getLikesToViewsPercentage(): float
    {
        return $this->likesToViewsPercentage;
    }
}