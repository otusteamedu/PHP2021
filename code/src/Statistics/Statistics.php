<?php

namespace Statistics;
use Elastic\Elastic;

class Statistics {
    private Elastic $elastic;
    private $allViewCount;
    private $allLikeCount;
    private $allDislikeCount;
    private $allChannelsStatistics;

    public function sortAllChannelsStatistics()
    {
        $allChannelsStatistics = $this->allChannelsStatistics();
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

        return $sortAllChannelsStatistics;
    }


    public function allChannelsStatistics()
    {
        $this->elastic = new Elastic('elasticsearch:9200');
        $indexParams = [
            'size' => '10000',
            'index' =>  'channels'
        ];
        $response = $this->elastic->search($indexParams);
        $totalChannels = $response['hits']['total']['value'];
        for ($i=0; $i < $totalChannels; $i++) { 
            $channelId = $response['hits']['hits'][$i]['_source']['id'];
            $subscriberCount = $response['hits']['hits'][$i]['_source']['subscriberCount'];
            $statisticsChannel = $this->statisticsChannel($channelId);
            $statisticsChannel['id_channel'] = $channelId;
            $statisticsChannel['subscriber_count'] = $subscriberCount;
            $this->allChannelsStatistics[] = $statisticsChannel;
        }

        return $this->allChannelsStatistics;

    }

    public function statisticsChannel($channelId)
    {
        $this->elastic = new Elastic('elasticsearch:9200');
        $indexParams = [
            'size' => '10000',
            'index' =>  'video',
            'body' => [
                'query' => [
                    "match" => [
                        'channels_id' => $channelId
                    ]
                ]   
            ]
        ];
        $response = $this->elastic->search($indexParams);
        $totalVideo = $response['hits']['total']['value'];

        for ($i=0; $i < $totalVideo; $i++) { 
            $viewCount = $response['hits']['hits'][$i]['_source']['viewCount'];
            $likeCount = $response['hits']['hits'][$i]['_source']['likeCount'];
            $dislikeCount = $response['hits']['hits'][$i]['_source']['dislikeCount'];

            $this->allViewCount += $viewCount;
            $this->allLikeCount += $likeCount;
            $this->allDislikeCount += $dislikeCount;
        }

        $statisChannel = [
            'all_view_count' => $this->allViewCount,
            'all_like_count' => $this->allLikeCount,
            'all_dislike_count' => $this->allDislikeCount,
        ];

        return $statisChannel;
    }

}