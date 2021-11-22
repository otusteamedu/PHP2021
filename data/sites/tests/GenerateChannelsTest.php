<?php

declare(strict_types=1);

namespace Tests;


use MySite\app\Services\YoutubeChannel\YoutubeChannelService;
use MySite\app\Support\Entities\YouTubeChannel;

/**
 * ./vendor/bin/phpunit --testdox ./tests/GenerateChannelsTest.php
 *
 * Class GenerateChannelsTest
 * @package Tests
 */
class GenerateChannelsTest extends BaseTest
{
    private const AMOUNT = 10;

    /**
     * ./vendor/bin/phpunit --testdox --filter testGenerateChannels  ./tests/GenerateChannelsTest.php
     */
    public function testGenerateChannels()
    {
        $channelService = new YoutubeChannelService();
        $collection = $this->generateChannels(self::AMOUNT);

        foreach ($collection->getIterator() as $channel) {
            /** @var YouTubeChannel $channel */
            $this->assertTrue(
                $channelService->saveChannel($channel)
            );
        }
        sleep(1);
    }


    /**
     * ./vendor/bin/phpunit --testdox --filter testGetAllChannels  ./tests/GenerateChannelsTest.php
     */
    public function testGetAllChannels()
    {
        $channelService = new YoutubeChannelService();
        $channels = $channelService->getAllChannels();
        $count = count($channels->getItems());
        $this->assertEquals(self::AMOUNT, $count);
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testDeleteChannels  ./tests/GenerateChannelsTest.php
     */
    public function testDeleteChannels()
    {
        $channelService = new YoutubeChannelService();
        $channels = $channelService->getAllChannels();

        if ($channels) {
            foreach ($channels->getIterator() as $channel) {
                /** @var YouTubeChannel $channel */
                $this->assertTrue(
                    $channelService->deleteChannel($channel)
                );
            }
        }
    }


}
