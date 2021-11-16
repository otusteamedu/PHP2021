<?php

namespace App\Add;

use App\Redis\ConnectCacheRedis;

class AddCacheAllEvent 
{ 
    private $allEvent;
    private $redisCache;
    private $date;
    private $key;

    public function __construct($allEvent)
    {
        $this->allEvent = $allEvent;
        $this->Add();
    }

    private function Add()
    {
        $this->redisCache = (new ConnectCacheRedis())->Connect();

        $this->key = "all_event_cache";
        $this->data = $this->allEvent;

        $this->data = json_encode($this->data, JSON_UNESCAPED_UNICODE);

        $this->redisCache->set($this->key, $this->data, 600);
    }
}