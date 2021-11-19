<?php

namespace Elastic\Repositories\ElasticSearch;

use Elastic\Exceptions\ChannelDoesntExistsException;
use Elastic\Models\Video;
use Elastic\Models\Contracts\Model;
use JetBrains\PhpStorm\Pure;

class VideoRepository extends ElasticSearchAbstractRepository implements \Elastic\Repositories\Contracts\Repository
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->indexExists(Video::INDEX)) {
            $this->createIndex(Video::SCHEMA);
        }
    }

    public function getAll(): array
    {
        $params = [
            'index' => Video::INDEX,
        ];

        $response = $this->client->search($params);

        return $this->convertESResponseToVideos($response);
    }

    public function find(string $id): ?Video
    {
        $params = [
            'index' => Video::INDEX,
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

    public function search(array $searchParams): array
    {
        $channel = $this->client->search($searchParams);

        return $this->convertESResponseToVideos($channel);
    }

    public function store(Model $model): ?string
    {
        $channelRepository = new ChannelRepository();

        if (is_null($model->getChannelId()) || !$channelRepository->exists($model->getChannelId())) {
            throw new ChannelDoesntExistsException();
        }

        $params = [
            'index' => Video::INDEX,
            'body' => [
                'channel_id' => $model->getChannelId(),
                'name' => $model->getName(),
                'description' => $model->getDescription(),
                'number_of_likes' => $model->getNumberOfLikes(),
                'number_of_dislikes' => $model->getNumberOfDislikes(),
            ]
        ];

        $response = $this->client->index($params);

        return $response['_id'] ?? null;
    }

    public function delete(string $id): ?bool
    {
        $params = [
            'index' => Video::INDEX,
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

    private function convertESResponseToVideos(array $response): array
    {
        $videos = [];

        foreach ($response['hits']['hits'] as $video) {
            $videos[] = new Video([
                'id' => $video['_id'],
                'channel_id' => $video['_source']['channel_id'],
                'name' => $video['_source']['name'],
                'description' => $video['_source']['description'],
                'number_of_likes' => $video['_source']['number_of_likes'],
                'number_of_dislikes' => $video['_source']['number_of_dislikes'],
            ]);
        }

        return $videos;
    }
}
