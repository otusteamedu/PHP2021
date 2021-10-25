<?php

namespace Elastic;
use Elasticsearch;

class Elastic 
{
    private $host;
    
    public function  __construct($host)
    {
            $this->host = $host;
    }

    public function clientBuilder() {
        $client = Elasticsearch\ClientBuilder::create()
        ->setSSLVerification(false)
        ->setHosts([$this->host])->build();

        return $client;
    }

    public function createIndex($params) {
        $client = $this->clientBuilder();
        $response = $client->indices()->create($params);
        
        return $response;
    }

    public function addDocument($params) {
        $client = $this->clientBuilder();
        $response = $client->index($params);
        
        return $response;
    }
    
    public function search($params)
    {
        $client = $this->clientBuilder();
        $response = $client->search($params);

        return $response;
    }

    public function update($params)
    {
        $client = $this->clientBuilder();
        $response = $client->update($params);

        return $response;
    }

    public function delete($params)
    {
        $client = $this->clientBuilder();
        $response = $client->delete($params);

        return $response;
    }

}