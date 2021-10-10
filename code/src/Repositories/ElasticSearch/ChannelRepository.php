<?php

namespace Elastic\Repositories\ElasticSearch;

use Elastic\Models\Channel;
use Elastic\Models\Contracts\Model;

class ChannelRepository extends ElasticSearchAbstractRepository implements \Elastic\Repositories\Contracts\Repository
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->indexExists(Channel::INDEX)) {
            $this->createIndex(Channel::SCHEMA);
        }
    }

    public function getAll(): array
    {
        $params = [
            'index' => Channel::INDEX,
        ];

        $response = $this->client->search($params);

        return $this->convertESResponseToChannels($response);
    }

    public function find(string $id): ?Channel
    {
        $params = [
            'index' => Channel::INDEX,
            'body' => [
                'query' =>  [
                    'match' => [
                        '_id' => $id,
                    ],
                ],
            ],
        ];

        return $this->search($params)[0] ?? null;
    }

    public function exists(string $id): bool
    {
        return !is_null($this->find($id));
    }

    public function search(array $searchParams): array
    {
        $channel = $this->client->search($searchParams);

        return $this->convertESResponseToChannels($channel);
    }

    public function store(Model $model): ?string
    {
        $params = [
            'index' => Channel::INDEX,
            'body' => [
                'name' => $model->name,
                'description' => $model->description,
                'number_of_subscribers' => $model->numberOfSubscribers,
            ]
        ];

        $response = $this->client->index($params);

        return $response['_id'] ?? null;
    }

    public function delete(string $id): ?bool
    {
        $params = [
            'index' => Channel::INDEX,
            'id' => $id,
        ];

        try {
            $response = $this->client->delete($params);
        }
        catch (\Exception $e) {
            return false;
        }

        return $response['result'] === 'deleted';
    }

    private function convertESResponseToChannels(array $response): array
    {
        $channels = [];

        foreach ($response['hits']['hits'] as $channel) {
            $channels[] = new Channel([
                'id' => $channel['_id'],
                'name' => $channel['_source']['name'],
                'description' => $channel['_source']['description'],
                'number_of_subscribers' => $channel['_source']['number_of_subscribers'],
            ]);
        }

        return $channels;
    }
}
