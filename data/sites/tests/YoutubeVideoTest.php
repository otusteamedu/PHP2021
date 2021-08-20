<?php

declare(strict_types=1);

namespace Tests;


use MySite\app\Repositories\VideoRepository;
use MySite\app\Support\Entities\YouTubeVideo;

/**
 * ./vendor/bin/phpunit --testdox ./tests/YoutubeVideoTest.php
 *
 * Class YoutubeVideoTest
 * @package Tests
 */
class YoutubeVideoTest extends BaseTest
{

    /**
     * ./vendor/bin/phpunit --testdox --filter testGetAllVideos ./tests/YoutubeVideoTest.php
     */
    public function testGetAllVideos()
    {
        $videos = VideoRepository::getAllVideos();
        $this->assertIsArray($videos);
    }

    /**
     * ./vendor/bin/phpunit --testdox --filter testDeleteAllVideos ./tests/YoutubeVideoTest.php
     */
    public function testDeleteAllVideos()
    {
        $videos = VideoRepository::getAllVideos();
        foreach ($videos as $video) {
            $this->assertTrue(
                VideoRepository::deleteVideo(
                    new YouTubeVideo($video['_id'])
                )
            );
        }
    }
}
