<?php

namespace App\Services\Youtube\Repositories\Background;

use App\Models\Video;
use Elasticsearch\Client;

final class ElasticsearchVideos
{

    private Client $elasticsearch;

    /**
     * @param Client $elasticsearch
     */
    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    /**
     * @return int
     */
    public function reindexAllVideos(): int
    {
        $reindexedVideos = 0;
        foreach (Video::cursor() as $video) {

            $this->elasticsearch->index([
                'index' => $video->getSearchIndex(),
                'type' => $video->getSearchType(),
                'id' => $video->getKey(),
                'body' => $video->toSearchArray(),
            ]);
            $reindexedVideos++;

        }
        return $reindexedVideos;
    }

}
