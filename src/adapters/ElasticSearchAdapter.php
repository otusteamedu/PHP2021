<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 17:12
 */

namespace app\adapters;

use app\helpers\ConfigHelper;
use app\models\elasticSearch\ElasticSearchModelInterface;
use Elasticsearch\Client as ESClient;
use Elasticsearch\ClientBuilder;

/**
 * Адаптер для ElasticSearch
 *
 * Class ElasticSearchAdapter
 * @package app\adapters
 */
class ElasticSearchAdapter
{
    /**
     * Клиент для работы ElasticSearch
     *
     * @var ESClient
     */
    private ESClient $elasticSearchClient;

    /**
     * ESProvider constructor.
     */
    public function __construct()
    {
        $config = new ConfigHelper();

        $this->elasticSearchClient = ClientBuilder::create()
            ->setHosts([$config->getEsHost()])
            ->build();
    }

    /**
     * Добавляет данные в индекс
     *
     * @param ElasticSearchModelInterface $model
     */
    public function index(ElasticSearchModelInterface $model)
    {
        $params = $model->getIndexParams();

        $this
            ->elasticSearchClient
            ->index($params);
    }

    /**
     * Добавляет данные в индекс
     *
     * @param ElasticSearchModelInterface $model
     *
     * @return array
     */
    public function search(ElasticSearchModelInterface $model): array
    {
        $params = $model->getIndexParams();

        return $this
            ->elasticSearchClient
            ->search($params);
    }

    /**
     * Удаление из индекса
     *
     * @param ElasticSearchModelInterface $model
     */
    public function delete(ElasticSearchModelInterface $model)
    {
        $params = $model->getIndexParams();
        unset($params['body']);

        $this
            ->elasticSearchClient
            ->delete($params);
    }
}
