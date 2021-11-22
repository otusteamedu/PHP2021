<?php

declare(strict_types=1);

namespace MySite\app\Repositories;


use MySite\app\Support\Entities\YouTubeChannel;
use MySite\app\Support\Entities\YouTubeVideo;
use MySite\app\Support\Facades\Schema;

/**
 * Class VideoRepository
 * @package MySite\app\Repositories
 */
final class VideoRepository
{

    private const TABLE = 'videos';

    /**
     * @param YouTubeVideo $video
     * @return bool
     */
    public static function createVideo(YouTubeVideo $video): bool
    {
        return Schema::connection()->create(
            [
                'index' => self::TABLE,
                'id' => $video->id(),
                'body' => [
                    'channel_id' => $video->channelId(),
                    'title' => $video->title(),
                    'description' => $video->description(),
                    'published_at' => $video->publishedAt(),
                ]
            ]
        );
    }

    /**
     * @param YouTubeVideo $video
     * @return bool
     */
    public static function deleteVideo(YouTubeVideo $video): bool
    {
        return Schema::connection()->delete(
            [
                'index' => self::TABLE,
                'id' => $video->id(),
            ]
        );
    }

    /**
     * @param YouTubeChannel $channel
     * @return array|null
     */
    public static function getVideosByChannel(YouTubeChannel $channel): ?array
    {
        return Schema::connection()->search(
            [
                'index' => self::TABLE,
                'body' => [
                    'query' => [
                        'match' => [
                            'channel_id' => $channel->id()
                        ]
                    ]
                ]

            ]
        );
    }

    /**
     * @return array|null
     */
    public static function getAllVideos(): ?array
    {
        return Schema::connection()->search(
            [
                'index' => self::TABLE,
            ]
        );
    }
}
