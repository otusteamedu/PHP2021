<?php

declare(strict_types=1);

namespace MySite\app\Services\YoutubeChannel;

use JetBrains\PhpStorm\Pure;

/**
 * Class YoutubeChannelStatisticService
 */
final class YoutubeChannelStatisticService
{
    /**
     * @var YoutubeChannelService
     */
    private YoutubeChannelService $channelService;

    /**
     * YoutubeChannelStatisticService constructor.
     */
    #[Pure] public function __construct()
    {
        $this->channelService = new YoutubeChannelService();
    }

    public function getBestChannels()
    {

    }

    /**
     * @param string $id
     * @return float|int
     */
    public function getLikesDislikesRatio(string $id): float|int
    {
        $ratio = 0;
        $channel = $this->channelService->getChannelById($id);

        if ($channel) {
            $ratio = $channel->likesAndDislikesRatio();
        }

        return $ratio;
    }

    /**
     * @param string $id
     * @return int
     */
    public function getLikes(string $id): int
    {
        $likes = 0;
        $channel = $this->channelService->getChannelById($id);
        if ($channel) {
            $likes = $channel->likes();
        }
        return $likes;
    }

    /**
     * @param string $id
     * @return int
     */
    public function getDislikes(string $id): int
    {
        $dislikes = 0;
        $channel = $this->channelService->getChannelById($id);
        if ($channel) {
            $dislikes = $channel->dislikes();
        }
        return $dislikes;
    }
}
