<?php

namespace Src\Infrastructure;

use Predis\Client;

class RedisTasks
{
    private object $redis;

    public function __construct()
    {
        $this->redis = $this->connect();
    }

    /**
     * @return Client
     */
    private function connect(): Client
    {
        $connection = [
            'schema'    => 'tcp',
            'host'      => 'redis',
            'port'      => 6379
        ];

        return new Client($connection);
    }

    /**
     * @return object|Client
     */
    public function getRedis(): ?Client
    {
        return $this->redis;
    }

    /**
     * @param $key
     * @param $priority
     * @param $event
     * @return void
     */
    public function add($key, $priority, $event): void
    {
        $this->redis->zadd($key, [
            $event => $priority
        ]);
    }

    /**
     * @param $key
     * @return array
     */
    public function revRangeByScore($key): array
    {
        return $this->redis->zrevrangebyscore(
            $key,
            '+inf',
            '-inf',
            [
                'withscores' => true,
                'limit'      => [
                    0,
                    1
                ]
            ]
        );
    }
}