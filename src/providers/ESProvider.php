<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 05.12.2021
 * Time: 17:12
 */

namespace app\providers;

use app\components\ESClient;
use app\indices\ChannelIndex;
use app\indices\VideoIndex;
use app\models\ChannelModel;
use app\models\VideoModel;
use Elasticsearch\Helper\Iterators\SearchHitIterator;

/**
 * Class ESProvider
 * @package app\providers
 */
class ESProvider
{
    /**
     * @var ESClient
     */
    private ESClient $esClient;

    /**
     * ESProvider constructor.
     */
    public function __construct()
    {
        $this->esClient = new ESClient();
    }

    /**
     * @param ChannelModel $channelModel
     */
    public function indexChannel(ChannelModel $channelModel)
    {
        $index = new ChannelIndex($channelModel);
        $params = $index->toParams();

        $this->index($params);
    }

    /**
     * @param ChannelModel $channelModel
     */
    public function deleteChannel(ChannelModel $channelModel)
    {
        $index = new ChannelIndex($channelModel);
        $params = $index->toParams();

        $this->delete($params);
    }

    /**
     * @param VideoModel[] $videos
     */
    public function indexVideos(array $videos)
    {
        $params = ['body' => []];

        foreach ($videos as $video) {
            $index = new VideoIndex($video);

            $params['body'][] = [
                'index' => [
                    '_index' => VideoIndex::index(),
                    '_id' => $index->getId(),
                ],
            ];

            $params['body'][] = $index->getBody();
        }

        $this
            ->esClient
            ->bulk($params);
    }

    /**
     * @param VideoModel $videoModel
     */
    public function deleteVideo(VideoModel $videoModel)
    {
        $index = new VideoIndex($videoModel);
        $params = $index->toParams();

        $this->delete($params);
    }

    public function search(string $channelId)
    {
        $params = [
            'index' => VideoIndex::index(),
            'scroll' => '1m',
//            "_source" => [
//                "title"
//            ],
            'body' => [
                'query' => [
                    'term' => [
                        'channel_id' => 'UCixlrqz8w-oa4UzdKyHLMaA'
                    ]
                ]
            ]
        ];


        $r = $this
            ->esClient
            ->search($params);

        $hits = new SearchHitIterator($r);

        foreach ($hits as $hit) {
            var_dump($hit["_id"]);
        }
    }

    /**
     * Добавляет данные в индекс
     * @param array $params
     */
    private function index(array $params)
    {
        $this
            ->esClient
            ->index($params);
    }

    /**
     * Удаление данные из индекса
     * @param array $params
     */
    private function delete(array $params)
    {
        $this
            ->esClient
            ->delete($params);
    }
}