<?php
declare(strict_types=1);
namespace App\Storage;

use Elasticsearch\ClientBuilder;
use App\Interface\StorageInterface;

class ESStorage implements StorageInterface
{
    private $mainFields = ['index', 'id'];
    private $client;
    private $hosts = [
        'elastic_search',
    ];

    public function __construct()
    {
        $this->client = ClientBuilder::create()->setHosts($this->hosts)->build();
    }

    public function insert(string $request) : array
    {
        return $this->client->index($this->getRequestBody($request));
    }

    public function delete(string $request)
    {
        return $this->client->delete($this->getRequestBody($request));
    }

    public function search(string $arData) : array
    {
        return $this->client->search($arData)['hits']['hits'];
    }

    private function getRequestBody(array $request) : array
    {
        switch ($request['index']) {
            case 'youtube_channel':
                return $this->makeChannelArray($request);

            case 'youtube_video':
                return $this->makeVideoArray($request);

            default:
                throw new \Exception('Wrong index passed');

        }
    }

    private function makeChannelArray(array $request) : array
    {
        return [
            'index' => $request['index'],
            'id'    => $request['id'],
            'body'  => [
                'channel_id'   => $request['id'],
                'channel_name' => $request['name']
            ]
        ];
    }

    private function makeVideoArray($request)
    {
        return [
            'index' => $request['index'],
            'id'    => $request['id'],
            'body'  => [
                'video_id'   => $request['id'],
                'title'      => $request['name'],
                'likes'      => $request['video_likes'],
                'dislikes'   => $request['video_dislikes'],
                'channel_id' => $request['video_channel_id'],
            ]
        ];
    }

    public function getMainFields() : array
    {
        return $this->mainFields;
    }
}