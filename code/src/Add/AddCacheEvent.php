<?php

namespace AddCacheEvent;

use ConnectCacheRedis\ConnectCacheRedis;

class AddCacheEvent 
{
    private $redisCache;
    private $parameters;
    private $suitableEvent;
    private $keys;
    private $allNumberKey;
    private $newKey;
    private $date;

    public function __construct($parameters, $suitableEvent)
    {
        $this->parameters = $parameters;
        $this->suitableEvent = $suitableEvent;

        $this->redisCache = (new ConnectCacheRedis())->Connect();
        $this->keys = $this->redisCache->keys('event_cache_*');

        if ($this->keys) {

            foreach ($this->keys as $key) {
                $numberKey = explode('_', $key);
                $numberKey = $numberKey[2];
                $this->allNumberKey[] = $numberKey;
            }

            $this->newKey = max($this->allNumberKey);
            $this->newKey++;
            
        } else {
            $this->newKey = '0';
        }

        $this->newKey = "event_cache_" . $this->newKey;
        $this->data = [
            'conditions' => $this->parameters,
            'event' => $this->suitableEvent
        ];

        $this->data = json_encode($this->data, JSON_UNESCAPED_UNICODE);

        $this->redisCache->set($this->newKey, $this->data, 600);
    }
    
}