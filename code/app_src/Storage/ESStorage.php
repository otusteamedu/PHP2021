<?php

namespace App\Storage;

use App\Interfaces\StorageInterface;
use Elasticsearch\ClientBuilder;

class ESStorage implements StorageInterface
{
    private $client;
    private $hosts = ['elastic_search'];

    public function __construct()
    {
        $this->client = ClientBuilder::create()->setHosts($this->hosts)->build();
    }

    public function insert(array $request): array
    {
        $result = $this->client->index($this->makeIndexArray($request));

        if ($result['result'] === 'created') {
            $result['action'] = 'add';
        }

        return $result;
    }

    public function deleteAll(): array
    {
        $arItems = $this->client->search([
            'index' => 'events'
        ]);

        foreach ($arItems['hits']['hits'] as $item) {
            $this->client->delete([
                'index' => 'events',
                'id' => $item['_id'],
            ]);
        }

        $result['action'] = 'delete';

        return $result;
    }

    public function searchEvent(array $arData): array
    {
        $arEvents = $this->getSuitableEvents($arData['conditions']);
        $arEventPriority = $this->getEventPriorityArray($arEvents);

        asort($arEventPriority);

        $result['action'] = 'search';
        $result['most_priority_event'] = array_key_last($arEventPriority);
        $result['priority'] = array_pop($arEventPriority);

        return $result;
    }

    private function getSuitableEvents(array $filter): array
    {
        $params = [
            'index' => 'events',
            'body' => [
                'query' => [
                    'bool' => [
                        'filter' => [
                            'term' => [
                                'conditions' => $filter
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $result = $this->client->search($params);

        return $result['hits']['hits'];

    }

    private function getEventPriorityArray(array $arEvents): array
    {
        $arEventPriority = [];

        foreach ($arEvents as $event) {
            $arEventPriority[$event['_source']['name']] = $event['_source']['priority'];
        }

        return $arEventPriority;
    }

    private function makeIndexArray($request): array
    {
        return [
            'index' => 'events',
            'body' => [
                'priority' => $request['priority'],
                'name' => $request['event'],
                'conditions' => array_map('trim', explode(',', $request['conditions'])),
            ]
        ];
    }
}
