<?php

namespace Elastic\Services;

use Elasticsearch\ClientBuilder;

class ESClientService
{
    private Config $config;

    public function __construct()
    {
        $this->config = new Config();
    }
    public function getClient()
    {
        $client = ClientBuilder::create()
            ->setHosts([
                'host' => $this->config->get('host'),
            ])
            ->build();

        return $client;
    }
}
