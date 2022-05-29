<?php

namespace App\Observers;

use App\Models\Youtubechannel;
use Elasticsearch\Client;

class YoutubechannelsObserver
{
    private Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function saved(Youtubechannel $model)
    {
        $this->elasticsearch->index(
            array_merge($this->generateElasticSearchParams($model), [
                'body' => $model->toSearchArray(),
            ]));
    }

    public function deleted(Youtubechannel $model)
    {
        $this->elasticsearch->delete(
            $this->generateElasticSearchParams($model)
        );
    }

    private function generateElasticSearchParams(Youtubechannel $model): array
    {
        return [
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
        ];
    }


}
