<?php

namespace Adding;

use Youtube\Api;
use Repositories\Channels;
use Repositories\Videos;
use Parse\Parse;

class Adding
{
    private Api $api;

    public function __construct($argv)
    {
        $googleKey = $argv[1];
        $channelsList = $argv[2];
        $channels_id = (new Parse())->parseFile($channelsList);

        foreach ($channels_id as $channel_id) {
            $this->api = new Api($googleKey);
            $channelInfo = $this->api->informationAboutTheChannel($channel_id);
            
            new Channels($channelInfo);

            $idVideo = $this->api->allIdVideo();
            
            for ($i=0; $i < count($idVideo); $i++) {
                $id = $idVideo[$i];
                $videolInfo = $this->api->informationAboutTheVideo($id);
                new Videos($videolInfo);
            }

        }
    }
}