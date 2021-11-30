<?php
namespace App\Repositories;

use App\Models\Video;
use Elasticsearch\Client;
use Illuminate\Support\Arr;

class ElasticSearchRepository
{
    /** @var \Elasticsearch\Client */
    private $elasticsearch;
    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $query = '')
    {
        $items = $this->searchOnElasticsearch($query);
        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query = ''): array
    {
        $model = new Video();
        $items = $this->elasticsearch->search([
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    "match" => [
                        "channel" => $query
                    ]
                ],
            ],
        ]);
        return $items;
    }
    private function buildCollection(array $items)
    {
        return collect($items['hits']['hits'])->map(function ($video) {
            return $video['_source'];
        });
    }
}