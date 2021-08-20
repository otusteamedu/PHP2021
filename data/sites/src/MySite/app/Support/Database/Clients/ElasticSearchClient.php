<?php

declare(strict_types=1);

namespace MySite\app\Support\Database\Clients;

use Elasticsearch\ClientBuilder;
use MySite\app\Support\Contracts\DatabaseClient;
use MySite\app\Support\Contracts\DatabaseQuery;
use MySite\app\Support\Database\Adapters\ElasticAdapter;

/**
 * Class ElasticSearchClient
 * @package MySite\app\Support\Database\Clients
 */
final class ElasticSearchClient implements DatabaseClient
{

    /**
     * @return DatabaseQuery
     */
    public static function run(): DatabaseQuery
    {
        return new ElasticAdapter(
            ClientBuilder::create()
                ->setHosts([getenv('ELASTIC_SEARCH_HOST')])
                ->build()
        );
    }
}
