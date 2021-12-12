<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 17:09
 */

namespace app\components;


use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Helper\Iterators\SearchResponseIterator;

/**
 * Клиент по работе с ElasticSearch
 *
 * Class ESClient
 * @package app\components
 */
class ESClient
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * ESClient constructor.
     */
    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts(['es:9200'])
            ->build();
    }

    /**
     * @param array $params
     * @return array|callable
     */
    public function index(array $params)
    {
        return $this
            ->client
            ->index($params);
    }

    /**
     * @param array $params
     * @return array|callable
     */
    public function bulk(array $params)
    {
        return $this
            ->client
            ->bulk($params);
    }

    /**
     * @param array $params
     * @return array|callable
     */
    public function delete(array $params)
    {
        unset($params['body']);

        return $this
            ->client
            ->delete($params);
    }

    /**
     * @param array $params
     * @return SearchResponseIterator
     */
    public function search(array $params): SearchResponseIterator
    {
        return new SearchResponseIterator($this->client, $params);
    }
}