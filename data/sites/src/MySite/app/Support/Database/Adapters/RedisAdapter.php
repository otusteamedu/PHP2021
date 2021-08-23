<?php

declare(strict_types=1);

namespace MySite\app\Support\Database\Adapters;


use MySite\app\Support\Contracts\DatabaseQuery;
use Redis;

/**
 * Class RedisAdapter
 * @package MySite\app\Support\Database\Adapters
 */
class RedisAdapter implements DatabaseQuery
{

    private string $table;

    /**
     * RedisAdapter constructor.
     * @param Redis $client
     */
    public function __construct(
        private Redis $client
    ) {
    }

    /**
     * @inheritDoc
     */
    public function create(?array $data): bool
    {
        $add = $this->client->zAdd(
            $data['key'],
            $data['options'],
            $data['score']
        );
        return $add > 0;
    }

    /**
     * @inheritDoc
     */
    public function delete(?array $data): bool
    {
        $result = (isset($data['value']))
            ? $this->client->zRem($data['key'], $data['value'])
            : $this->client->del($data['key']);
        return $result > 0;
    }

    /**
     * @inheritDoc
     */
    public function get(?array $data): ?array
    {
        $result = null;
        if (isset($data['keys'])) {
            $result = $this->client->keys($data['keys']);
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function clear(): bool
    {
        return $this->client->flushAll();
    }

    /**
     * @inheritDoc
     */
    public function search(?array $data): ?array
    {
        if (isset($data['reverse'])) {
            return $this->client->zRevRange(
                $data['key'],
                $data['start'],
                $data['end']
            );
        } else {
            return $this->client->zRange(
                $data['key'],
                $data['start'],
                $data['end']
            );
        }
    }
}
