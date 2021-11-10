<?php

namespace AddCacheAllEvent;

use ConnectCacheRedis\ConnectCacheRedis;

class AddCacheAllEvent 
{ 
    private $redisCache;
    private $date;
    private $key;

    public function __construct($allEvent)
    {
        $this->redisCache = (new ConnectCacheRedis())->Connect();

        $this->key = "all_event_cache";
        $this->data = $allEvent;

        $this->data = json_encode($this->data, JSON_UNESCAPED_UNICODE);

        $this->redisCache->set($this->key, $this->data, 600);
    }
}