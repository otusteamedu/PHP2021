<?php

declare(strict_types=1);

namespace MySite\app\Support\Database\Clients;


use MySite\app\Support\Contracts\DatabaseClient;
use MySite\app\Support\Contracts\DatabaseQuery;
use MySite\app\Support\Database\Adapters\RedisAdapter;
use Redis;

/**
 * Class ElasticSearchClient
 * @package MySite\app\Support\Database\Clients
 */
final class RedisClient implements DatabaseClient
{

    /**
     * @return DatabaseQuery
     */
    public static function run(): DatabaseQuery
    {
        $client = new Redis();
        $client->connect(
            getenv('REDIS_HOST'),
            (int)getenv('REDIS_PORT')
        );
        return new RedisAdapter($client);
    }
}
