<?php

namespace Elastic\Models;

use Elastic\Models\Contracts\Model;
use Elastic\Repositories\ElasticSearch\VideoRepository;

class Channel implements Model
{
    private ?string $id;
    private ?string $name;
    private ?string $description;
    private ?int $numberOfSubscribers;

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

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getNumberOfSubscribers(): ?int
    {
        return $this->numberOfSubscribers;
    }

    public function setNumberOfSubscribers(int $numberOfSubscribers): void
    {
        $this->numberOfSubscribers = $numberOfSubscribers;
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
