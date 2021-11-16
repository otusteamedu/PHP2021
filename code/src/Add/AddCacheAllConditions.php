<?php

namespace App\Add;

use App\Redis\ConnectCacheRedis;

class AddCacheAllConditions 
{ 
    private $allConditions;
    private $redisCache;
    private $date;
    private $key;

    public function __construct($allConditions)
    {
        $this->allConditions = $allConditions;
        $this->Add();
    }

    private function Add()
    {
        $this->redisCache = (new ConnectCacheRedis())->Connect();
        $this->key = "all_conditions_cache";
        $this->data = $this->allConditions;

        $this->data = json_encode($this->data, JSON_UNESCAPED_UNICODE);

        $this->redisCache->set($this->key, $this->data, 600);
    }
}