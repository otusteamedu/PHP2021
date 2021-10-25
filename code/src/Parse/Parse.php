<?php

namespace Parse;

class Parse {

    public function parseFile($channelsList)
    {
        $file = $channelsList;
        $channelsList = file($file, FILE_IGNORE_NEW_LINES);

        foreach ($channelsList as $channel) {
            $path = parse_url($channel);
            $path = $path['path'];
            $channel_id = explode("/", $path);
            $channel_id = $channel_id[2];
            $channels_id[] = $channel_id;
        }
        
        return $channels_id;
    }

}