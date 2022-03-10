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

    public function toArray(): array
    {
        $item = [
            'channel_id'  => $this->channelId,
            'total_views' => $this->totalViews,
            'total_likes' => $this->totalLikes,
        ];
        if ($this->likesToViewsPercentage !== null) {
            $item['likes_to_views_percentage'] = $this->likesToViewsPercentage;
        }

        return $item;
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