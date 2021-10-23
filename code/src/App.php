<?php

namespace App;

use App\App;
use Youtube\Api;
use Repositories\Channels;
use Repositories\Videos;
use Statistics\Statistics;

class App
{
    
    private $googleKey;
    private Api $api;
    private Channels $channels;
    private Videos $videos;
    private $channelInfo;
    private $idVideo;
    private $videolInfo;
    private Statistics $statistics;

    public function __construct($googleKey)
    {
        $this->googleKey = $googleKey[1];
    }

    public function run($channelsList) {
    
        $file = $channelsList[2];
        $channelsList = file($file, FILE_IGNORE_NEW_LINES);
    
        foreach ($channelsList as $channel) {

            $path = parse_url($channel);
            $path = $path['path'];
            $channel_id = explode("/", $path);
            $channel_id = $channel_id[2];
            
            $this->api = new Api($this->googleKey);
            $this->channelInfo = $this->api->informationAboutTheChannel($channel_id);

            $idUploads = $this->channelInfo->items[0]->contentDetails->relatedPlaylists->uploads;
            $videoCount = $this->channelInfo->items[0]->statistics->videoCount;
            
            $this->channels = new Channels();
            $client = $this->channels->addChannels($this->channelInfo);

            $this->idVideo = $this->api->allIdVideo($idUploads, $videoCount);
            
            for ($i=0; $i < count($this->idVideo); $i++) {
                $id = $this->idVideo[$i];
                $this->videolInfo = $this->api->informationAboutTheVideo($id);
                $this->videos = new Videos();
                $this->videos->addVideo($this->videolInfo);
            }

            $this->statistics = new Statistics();
            $allChannelsStatistics = $this->statistics->allChannelsStatistics();
            $countChannels = count($allChannelsStatistics);

            for ($i=0; $i < $countChannels; $i++) { 
                $allLikeCount = $allChannelsStatistics[$i]['all_like_count'];
                $allDislikeCount = $allChannelsStatistics[$i]['all_dislike_count'];
                $rating = $allLikeCount/$allDislikeCount;
                $sortAllChannelsStatistics[$i]['rating'] = $rating;
                $sortAllChannelsStatistics[$i]['statistics'] = $allChannelsStatistics[$i];
            }

            uasort ( $sortAllChannelsStatistics , function ($a, $b) {
                    return ($a['rating'] < $b['rating']);
                }
            );

            foreach ($sortAllChannelsStatistics as $sortAllChannelStatistics) {
                echo "Id канала: " . $sortAllChannelStatistics['statistics']['id_channel'] . "\n";
                echo "Рейтинг канала: " . round($sortAllChannelStatistics['rating'], 2) . "\n";
                echo "Количество просмотров: " . $sortAllChannelStatistics['statistics']['all_view_count'] . "\n";
                echo "Количество подписчиков: " . $sortAllChannelStatistics['statistics']['subscriber_count'] . "\n";
                echo "Количество лайков: " . $sortAllChannelStatistics['statistics']['all_like_count'] . "\n";
                echo "Количество дизлайков: " . $sortAllChannelStatistics['statistics']['all_dislike_count'] . "\n\n";
            }
        }

    }
   
}

