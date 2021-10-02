<?php

namespace App\Services\Youtube\Repositories\Statistics\Elasticsearch;

use App\Models\Video;
use Elasticsearch\Client;

abstract class ElasticsearchStatistics
{

    protected Video $model;

    protected abstract function formatData(array $inputArray): array;

    protected Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
        $this->model = new Video();
    }
}
