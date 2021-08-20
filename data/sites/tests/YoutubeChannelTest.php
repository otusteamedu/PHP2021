<?php

declare(strict_types=1);

namespace Tests;


use MySite\app\Repositories\ChannelRepository;
use MySite\app\Services\YoutubeChannel\YoutubeChannelService;
use MySite\app\Services\YoutubeVideo\YoutubeVideoService;
use MySite\app\Support\Entities\YouTubeChannel;

/**
 * ./vendor/bin/phpunit --testdox ./tests/YoutubeChannelTest.php
 *
 * Class YoutubeMapperTest
 * @package Tests
 */
class YoutubeChannelTest extends BaseTest
{
    /**
     * ./vendor/bin/phpunit --testdox --filter testCreateChannel ./tests/YoutubeChannelTest.php
     */
    public function testCreateChannel()
    {
        $youTubeChannelDTO = $this->createMockChannel();
        $this->assertIsObject($youTubeChannelDTO);
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testSaveChannel ./tests/YoutubeChannelTest.php
     */
    public function testSaveChannel()
    {
        $youTubeChannelDTO = $this->createMockChannel();
        $result = (new YoutubeChannelService())->saveChannel($youTubeChannelDTO);
        sleep(1);
        $this->assertTrue($result);
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testGetChannel ./tests/YoutubeChannelTest.php
     */
    public function testGetChannel()
    {
        $result = (new YoutubeChannelService())->getChannelById('testChannel');
        $this->assertInstanceOf(YouTubeChannel::class, $result);
        $this->assertEquals('testChannel', $result->id());
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testDeleteChannel ./tests/YoutubeChannelTest.php
     */
    public function testDeleteChannel()
    {
        $youTubeChannelDTO = $this->createMockChannel();
        $result = (new YoutubeChannelService())->deleteChannel($youTubeChannelDTO);
        $this->assertTrue($result);
    }
}
