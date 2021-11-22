<?php

declare(strict_types=1);

namespace MySite\app\Repositories;


use MySite\app\Support\Entities\YouTubeChannel;
use MySite\app\Support\Facades\Schema;
use MySite\app\Support\Iterators\Collection;

/**
 * Class ChannelRepository
 * @package MySite\app\Repositories
 */
final class ChannelRepository
{
    private const TABLE = 'channels';

    /**
     * @param YouTubeChannel $channel
     * @return bool
     */
    public static function createChannel(YouTubeChannel $channel): bool
    {
        return Schema::connection()->create(
            [
                'index' => self::TABLE,
                'id' => $channel->id(),
                'body' => [
                    'id' => $channel->id(),
                    'title' => $channel->title(),
                    'likes' => $channel->likes(),
                    'dislikes' => $channel->dislikes(),
                    'likesAndDislikesRatio' => $channel->likesAndDislikesRatio()
                ]
            ]
        );
    }

    /**
     * @param YouTubeChannel $channel
     * @return bool
     */
    public static function deleteChannel(YouTubeChannel $channel): bool
    {
        return Schema::connection()->delete(
            [
                'index' => self::TABLE,
                'id' => $channel->id(),
            ]
        );
    }

    /**
     * @param string $id
     * @return array|null
     */
    public static function findById(string $id): ?array
    {
        return Schema::connection()->get(
            [
                'index' => self::TABLE,
                'id' => $id,
            ]
        );
    }

    /**
     * @param array $data
     * @param array $body
     * @return array|null
     */
    public static function findByDetails(array $data = [], array $body = []): ?array
    {
        $data['index'] = self::TABLE;
        $data['body'] = $body;
        return Schema::connection()->search($data);
    }


    /**
     * @param int $size
     * @return array|null
     */
    public static function getTop(int $size): ?array
    {
        $request = [
            'size' => $size,
        ];
        $body = [
            'sort' => [
                'likesAndDislikesRatio' => ['order' => 'desc']
            ]
        ];
        return self::findByDetails($request, $body);
    }
}
