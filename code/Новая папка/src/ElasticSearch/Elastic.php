<?php

namespace Elastic\ElasticSearch;

class Elastic 
{
    private $host;

    public function  __construct($host)
    {
        if ($host) {
            $this->host = $host;
        } else {
            $this->host = "elasticsearch:9200";
        }
    }

    public function clientBuilder() {
        $client = Elasticsearch\ClientBuilder::create()
        ->setSSLVerification(false)
        ->setHosts([$this->host])->build();

        return $client;
    }

    // Создание индекса
    public function createIndex($params) {
        $client = $this->clientBuilder();
        $response = $client->indices()->create($params);
        
        return $response;
    }

    // Добавление документа
    public function addDocument($params) {
        $client = $this->clientBuilder();
        $response = $client->index($params);
        
        return $response;
    }
    
    // Поиск
    public function search($params)
    {
        $client = $this->clientBuilder();
        $response = $client->search($params);

        return $response;
    }

}