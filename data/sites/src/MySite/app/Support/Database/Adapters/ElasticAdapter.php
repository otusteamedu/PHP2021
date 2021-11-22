<?php

declare(strict_types=1);

namespace MySite\app\Support\Database\Adapters;


use Elasticsearch\Client;
use MySite\app\Support\Contracts\DatabaseQuery;

/**
 * Class ElasticAdapter
 * @package MySite\app\Support\Database\Adapters
 */
class ElasticAdapter implements DatabaseQuery
{

    private string $table;

    public function __construct(
        private Client $client
    ) {
    }

    /**
     * @inheritDoc
     */
    public function create(?array $data): bool
    {
        return is_array($this->client->index($data));
    }

    /**
     * @inheritDoc
     */
    public function delete(?array $data): bool
    {
        return is_array($this->client->delete($data));
    }

    /**
     * @inheritDoc
     */
    public function get(?array $data): ?array
    {
        try {
            $request = $this->client->get($data);
            return $request['_source'];
        } catch (\Throwable $exception) {
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function search(?array $data): ?array
    {
        try {
            $request = $this->client->search($data);
            return $request['hits']['hits'];
        } catch (\Throwable $exception) {
            return null;
        }
    }
}
