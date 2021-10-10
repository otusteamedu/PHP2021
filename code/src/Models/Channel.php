<?php

namespace Elastic\Models;

use Elastic\Models\Contracts\Model;
use Elastic\Repositories\ElasticSearch\VideoRepository;

class Channel implements Model
{
    public ?string $id;
    public ?string $name;
    public ?string $description;
    public ?int $numberOfSubscribers;

    public const INDEX = 'channel';
    public const SCHEMA = [
        'index' => self::INDEX,
        'body' => [
            'mappings' => [
                'properties' => [
                    'name' => [
                        'type' => 'text',
                    ],
                    'description' => [
                        'type' => 'text',
                    ],
                    'numberOfSubscribers' => [
                        'type' => 'integer',
                    ],
                ],
            ],
        ],
    ];

    public function __construct(array $channelData)
    {
        $this->id = $channelData['id'] ?? null;
        $this->name = $channelData['name'] ?? null;
        $this->description = $channelData['description'] ?? null;
        $this->numberOfSubscribers = $channelData['number_of_subscribers'] ?? null;
    }

    public function videos(): array
    {
        $params = [
            'index' => Video::INDEX,
            'body' => [
                'query' => [
                    'term' => [
                        'channel_id' => $this->id,
                    ]
                ]
            ]
        ];

        $videoRepository = new VideoRepository();

        return $videoRepository->search($params);
    }
}
