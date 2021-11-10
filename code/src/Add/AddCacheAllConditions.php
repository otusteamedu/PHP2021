<?php

namespace AddCacheAllConditions;

use ConnectCacheRedis\ConnectCacheRedis;

class AddCacheAllConditions 
{ 
    private $redisCache;
    private $date;
    private $key;

    public function __construct($allConditions)
    {
        $this->redisCache = (new ConnectCacheRedis())->Connect();

        $this->key = "all_conditions_cache";
        $this->data = $allConditions;

        $this->data = json_encode($this->data, JSON_UNESCAPED_UNICODE);

        $this->redisCache->set($this->key, $this->data, 600);
    }
}