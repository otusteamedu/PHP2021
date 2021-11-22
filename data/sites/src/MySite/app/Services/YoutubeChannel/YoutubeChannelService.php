<?php

declare(strict_types=1);

namespace MySite\app\Services\YoutubeChannel;


use Closure;
use MySite\app\Repositories\ChannelRepository;
use MySite\app\Repositories\VideoRepository;
use MySite\app\Support\Entities\YouTubeChannel;
use MySite\app\Support\Entities\YouTubeVideo;
use MySite\app\Support\Iterators\Collection;

/**
 * Class YoutubeChannelService
 * @package MySite\app\Services\YoutubeChannel
 */
final class YoutubeChannelService
{

    /**
     * @param YouTubeChannel $channel
     * @return bool
     */
    public function saveChannel(YouTubeChannel $channel): bool
    {
        $saveChannel = ChannelRepository::createChannel($channel);
        if ($saveChannel) {
            foreach ($channel->videos() as $video) {
                VideoRepository::createVideo($video);
            }
        }
        return $saveChannel;
    }

    /**
     * @param YouTubeChannel $channel
     * @return bool
     */
    public function deleteChannel(YouTubeChannel $channel): bool
    {
        $deleteChannel = ChannelRepository::deleteChannel($channel);
        if ($deleteChannel) {
            foreach ($channel->videos() as $video) {
                VideoRepository::deleteVideo($video);
            }
        }
        return $deleteChannel;
    }

    /**
     * @return Collection
     */
    public function getAllChannels(): Collection
    {
        $result = new Collection();
        $channels = ChannelRepository::findByDetails();
        if ($channels) {
            array_map(
                $this->prepareChannel($result),
                $channels
            );
        }
        return $result;
    }

    /**
     * @param int $size
     * @return Collection
     */
    public function getTopChannels(int $size = 10): Collection
    {
        $result = new Collection();
        $channels = ChannelRepository::getTop($size);
        if ($channels) {
            array_map(
                $this->prepareChannel($result),
                $channels
            );
        }
        return $result;
    }

    /**
     * @param YouTubeChannel $channel
     */
    private function addVideosToChannel(YouTubeChannel $channel)
    {
        $videos = VideoRepository::getVideosByChannel($channel);
        if ($videos) {
            foreach ($videos as $video) {
                $YouTubeVideo = new YouTubeVideo($video['_id']);
                $YouTubeVideo
                    ->setChannelId($video['_source']['channel_id'])
                    ->setTitle($video['_source']['title'])
                    ->setDescription($video['_source']['description'])
                    ->setPublishedAt($video['_source']['published_at']);

                $channel->addVideo($YouTubeVideo);
            }
        }
    }

    /**
     * @param string $id
     * @return YouTubeChannel|null
     */
    public function getChannelById(string $id): ?YouTubeChannel
    {
        $channel = null;
        $request = ChannelRepository::findById($id);
        if ($request) {
            $channel = (new YouTubeChannel($request['id']))
                ->addLikes($request['likes'])
                ->addDislikes($request['dislikes'])
                ->setTitle($request['title']);
        }
        return $channel;
    }

    /**
     * @param $result
     * @return Closure
     */
    private function prepareChannel($result): Closure
    {
        return function ($elem) use ($result) {
            $channel =
                (new YouTubeChannel($elem['_id']))
                    ->addLikes($elem['_source']['likes'])
                    ->addDislikes($elem['_source']['dislikes'])
                    ->setTitle($elem['_source']['title']);

            $this->addVideosToChannel($channel);

            $result->addItem($channel);
        };
    }
}
