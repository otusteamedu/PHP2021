<?php


namespace Tests;


use Closure;
use MySite\app\Services\YoutubeChannel\YoutubeChannelService;
use MySite\app\Services\YoutubeChannel\YoutubeChannelStatisticService;
use MySite\app\Support\Entities\YouTubeChannel;

/**
 * ./vendor/bin/phpunit --testdox ./tests/StatisticsTest.php
 *
 * Class StatisticsTest
 * @package Tests
 */
class StatisticsTest extends BaseTest
{

    /**
     * ./vendor/bin/phpunit --testdox --filter testLikesDislikesRatio ./tests/StatisticsTest.php
     */
    public function testLikesDislikesRatio()
    {
        $channelService = new YoutubeChannelService();
        $statisticService = new YoutubeChannelStatisticService();

        $youTubeChannelDTO = $this->createMockChannel();
        $this->assertTrue(
            $channelService->saveChannel($youTubeChannelDTO)
        );

        sleep(1);

        $ratio = $statisticService->getLikesDislikesRatio($youTubeChannelDTO->id());
        $this->assertIsNumeric($ratio);

        $this->assertTrue(
            $channelService->deleteChannel($youTubeChannelDTO)
        );
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testBestChannels ./tests/StatisticsTest.php
     */
    public function testBestChannels()
    {
        $amount = 10;
        $limit = 3;
        $channelService = new YoutubeChannelService();
        $collection = $this->generateChannels($amount);

        foreach ($collection->getIterator() as $channel) {
            /** @var YouTubeChannel $channel */
            $this->assertTrue(
                $channelService->saveChannel($channel)
            );
        }

        $collection->usort($this->sortByRatio());
        $slice = $collection->slice(0, $limit);

        sleep(1);

        $collectionFromDb = $channelService->getTopChannels($limit);

        foreach ($collection->getIterator() as $channel) {
            $this->assertTrue(
                $channelService->deleteChannel($channel)
            );
        }
        $this->assertEquals($collectionFromDb, $slice);
    }

    /**
     * @return Closure
     */
    private function sortByRatio(): Closure
    {
        return
            fn(YouTubeChannel $first, YouTubeChannel $second) => $second->likesAndDislikesRatio(
                ) <=> $first->likesAndDislikesRatio();
    }
}
