<?php

namespace App\Observers;

use App\Models\Video;
use Elasticsearch\Client;

final class VideoObserver
{
    private Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function saved(Video $model)
    {
        $this->elasticsearch->index(
            array_merge($this->generateElasticSearchParams($model), [
                'body' => $model->toSearchArray(),
            ])
        );
    }

    public function deleted(Video $model)
    {
        $this->elasticsearch->delete(
            $this->generateElasticSearchParams($model)
        );
    }

    private function generateElasticSearchParams(Video $model): array
    {
        return [
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
        ];
    }

}
