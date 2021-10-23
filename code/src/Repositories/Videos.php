<?php

namespace Repositories;

use Models\Video;
use Elastic\Elastic;

class Videos
{
    private Video $video;
    private Elastic $elastic;
    private $videolInfo;

    public function addVideo($videolInfo) {
        $this->videolInfo = $videolInfo;
        $this->videolInfo = $videolInfo;
        $this->video = new Video($this->videolInfo);
    
        $videolId = $this->video->getId();
        $channelsId = $this->video->getChannelsId();
        $videolTitle = $this->video->getTitle();
        $videolViewCount = $this->video->getViewCount();
        $videolLikeCount = $this->video->getLikeCount();
        $videolDislikeCount = $this->video->getDislikeCount();
        $index = $this->video->index;

        $ch = curl_init('elasticsearch:9200/_aliases');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        $response = json_decode($response, true);
        $availabilityIndex = array_key_exists($index, $response);
        curl_close($ch);

        $this->elastic = new Elastic('elasticsearch:9200');

        if (!$availabilityIndex) {
            $indexParams = $this->video->schemaVideo;
            $response = $this->elastic->createIndex($indexParams);
        }


        $indexParams = [
            'index' => $index,
            'body' => [
                'query' => [
                    "match" => [
                        'id' => $videolId
                    ]
                ]   
            ]
        ];
        $response = $this->elastic->search($indexParams);
        $numberMatches = $response['hits']['total']['value'];

        if ($numberMatches == 0) {
            $indexParams = [
                'index' => $index,
                'body'  => [ 
                    'id' => $videolId,
                    'channels_id' => $channelsId,
                    'title' => $videolTitle,
                    'viewCount' => $videolViewCount,
                    'likeCount' => $videolLikeCount,
                    'dislikeCount' => $videolDislikeCount
                ]
            ];
            $response = $this->elastic->addDocument($indexParams);
        } else {
            $idDoc = $response['hits']['hits'][0]['_id'];
            $indexParams = [
                'index' => $index,
                'id' => $idDoc,
                'body' => [
                    'doc' => [
                        'id' => $videolId,
                        'channels_id' => $channelsId,
                        'title' => $videolTitle,
                        'viewCount' => $videolViewCount,
                        'likeCount' => $videolLikeCount,
                        'dislikeCount' => $videolDislikeCount
                    ]
                ]
            ];
            $response = $this->elastic->update($indexParams);
        }

    }
}