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
        return $items;
    }

    private function searchOnElasticsearch(string $query = ''): array
    {
        $model = new Video();
        $items = $this->elasticsearch->search([
//            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'match' => [
                        'query' => json_encode(['channel' => '10: Abe Bogisich'])
                    ]
//                    'multi_match' => [
//                        'fields' => ['title^5', 'body', 'tags'],
//                        'query' =>
//                            ["term" =>
//                                ["channel" => "курткa"]
//                            ],
//                            $query,
//                    ],
                ],
            ],
        ]);
        return $items;
    }
    private function buildCollection(array $items)
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');
//        return Article::findMany($ids)
//            ->sortBy(function ($article) use ($ids) {
//                return array_search($article->getKey(), $ids);
//            });
    }
}