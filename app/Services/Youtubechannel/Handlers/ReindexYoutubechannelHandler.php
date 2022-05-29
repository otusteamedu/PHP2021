<?php
/**
 * Description of ReindexYoutubechannelHandler.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Youtubechannel\Handlers;


use App\Models\Youtubechannel;
use Elasticsearch\Client;

class ReindexYoutubechannelHandler
{

    private Client $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

    public function handle(Youtubechannel $youtubechannel)
    {
        $this->client->index(array_merge($this->generateElasticSearchParams($youtubechannel), [
            'body' => $youtubechannel->toSearchArray(),
        ]));
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
