<?php


namespace HW9\Controllers;

use HW9\Search\Channel\Channel as SearchChannel;
use HW9\Search\Channel\Video as SearchVideo;
use HW9\Search\Index;
use HW9\YouTube\Channel\ChannelList as YoutubeChannelList;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->initYoutube();
        $this->initSearch();
    }

    public function index()
    {
        $mapping = getenv('ELASTICSEARCH_MAPPING', true) ?: getenv('ELASTICSEARCH_MAPPING');
        $index = new Index($this->search->getClient());
        $index->initFromMappingFile($mapping);

        $links = $this->getChannelsLinks();
        $channel_list = new YouTubeChannelList();
        $channel_list->initFromArray($links);

        foreach ($channel_list->items as &$channel) {
            $channel->setService($this->youtube->getService());
            $channel->retrieveTitle();
            $channel->retrieveVideos();
            $channel->countStatistics();
        }

        $search_channel = new SearchChannel();
        $search_channel->setClient($this->search->getClient());
        $search_video = new SearchVideo();
        $search_video->setClient($this->search->getClient());

        foreach ($channel_list as $channel) {
            $search_channel->add($channel);
            foreach ($channel->video_list->items as $video) {
                $search_video->add($video);
            }
        }
    }

    private function getChannelsLinks() : array
    {
        $src = getenv('CHANEL_LIST_JSON', true) ?: getenv('CHANEL_LIST_JSON');
        if (!file_exists($src)) {
            throw new Exception('Channel list JSON file not available, file name given: ' . $src);
        }

        $links = json_decode(file_get_contents($src), 1);
        if (empty($links)) {
            throw new Exception('Read zero channels from file ' . $src);
        }

        return $links;
    }
}
