<?php

namespace HW9\YouTube;

class YouTube
{
    protected const SEARCH_LIST_MAX_RESULTS = 50;
    protected $service = null;
    
    public function __construct()
    {
    }
    
    public function initService($settings) : void
    {
        $client = new \Google\Client();
        $client->setApplicationName($settings->getAppName());
        $client->setDeveloperKey($settings->getApiKey());
     
        $this->service = new \Google\Service\YouTube($client);
    }

    public function getService()
    {
        return $this->service;
    }

    public function setService($service)
    {
        $this->service = $service;
    }
}
