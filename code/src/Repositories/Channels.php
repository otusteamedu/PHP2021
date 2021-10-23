<?php

namespace Repositories;

use Models\Channel;
use Elastic\Elastic;

class Channels
{
    private Channel $channel;
    private Elastic $elastic;
    private $channelInfo;
    
    public function addChannels($channelInfo) {

        $this->channelInfo = $channelInfo;
        $this->channel = new Channel($this->channelInfo);
        
        $channelId = $this->channel->getId();
        $channelUploads = $this->channel->getUploads();
        $channelSubscriberCount = $this->channel->getSubscriberCount();
        $channelVideoCount = $this->channel->getVideoCount();
        $channelViewCount = $this->channel->getViewCount();
        $index = $this->channel->index;

        $ch = curl_init('elasticsearch:9200/_aliases');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        $response = json_decode($response, true);
        $availabilityIndex = array_key_exists($index, $response);
        curl_close($ch);

        $this->elastic = new Elastic('elasticsearch:9200');
        // $indexParams = [
        //     'size' => '1000',
        //     'index' => $index
        // ];
        // $response = $this->elastic->search($indexParams);
        if (!$availabilityIndex) {
            $indexParams = $this->channel->schemaChannels;
            $response = $this->elastic->createIndex($indexParams);
        }
        
        $indexParams = [
            'index' => $index,
            'body' => [
                'query' => [
                    "match" => [
                        'id' => $channelId
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
                    'id' => $channelId,
                    'uploads' => $channelUploads,
                    'subscriberCount' => $channelSubscriberCount,
                    'videoCount' => $channelVideoCount,
                    'viewCount' => $channelViewCount
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
                        'id' => $channelId,
                        'uploads' => $channelUploads,
                        'subscriberCount' => $channelSubscriberCount,
                        'videoCount' => $channelVideoCount,
                        'viewCount' => $channelViewCount
                    ]
                ]
            ];
            $response = $this->elastic->update($indexParams);
        }

        return $response;
    }

}