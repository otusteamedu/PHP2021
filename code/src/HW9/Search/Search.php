<?php

namespace HW9\Search;

use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;

class Search
{
    protected $client = null;
    protected const INDEX_CHANNELS = 'channels';
    protected const INDEX_VIDEOS = 'videos';

    public function initClient($settings) : void
    {
        $this->client = ClientBuilder::create()
            ->setHosts(array($settings->getHost()))
            ->build();
    }

    public function getClient() : Client
    {
        return $this->client;
    }

    public function setClient($client) : void
    {
        $this->client = $client;
    }
}
