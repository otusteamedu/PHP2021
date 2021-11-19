<?php

namespace Elastic\Repositories\ElasticSearch;

use Elastic\Models\Channel;
use Elastic\Services\ESClientService;
use Elasticsearch\Client;

class ElasticSearchAbstractRepository
{
    protected Client $client;

    public function __construct()
    {
        $this->client = (new ESClientService())->getClient();
    }

    protected function indexExists(string $index): bool
    {
        return $this->client->indices()->exists(['index' => $index]);
    }

    protected function createIndex(array $params): void
    {
        $this->client->indices()->create($params);
    }
}
