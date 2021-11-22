<?php

declare(strict_types=1);

namespace Tests;

use DateTimeImmutable;
use MySite\app\Support\Entities\YouTubeChannel;
use MySite\app\Support\Entities\YouTubeVideo;
use MySite\app\Support\Iterators\Collection;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{

    /**
     * @param int $num
     * @return Collection
     */
    protected function generateChannels(int $num): Collection
    {
        $collection = new Collection();
        for ($i = 0; $i < $num; $i++) {
            $youTubeChannelDTO = $this->createMockChannel('testChannel' . $i);
            $collection->addItem($youTubeChannelDTO);
        }
        return $collection;
    }

    /**
     * @param string $id
     * @return YouTubeChannel
     */
    protected function createMockChannel(string $id = 'testChannel'): YouTubeChannel
    {
        $youTubeChannelDTO = new YouTubeChannel($id);

        $date = new DateTimeImmutable('now');

        $youTubeChannelDTO
            ->setTitle('testTitle' . $id)
            ->addLikes(rand(100, 1000))
            ->addDislikes(rand(100, 1000));

        $youTubeVideo = new YouTubeVideo('testVideo' . $id);

        $youTubeVideo
            ->setChannelId($youTubeChannelDTO->id())
            ->setTitle('testVideo')
            ->setDescription('testVideoDescription')
            ->setPublishedAt($date->format("Y-m-d H:i:s"));


        $youTubeChannelDTO->addVideo($youTubeVideo);

        return $youTubeChannelDTO;
    }
}
