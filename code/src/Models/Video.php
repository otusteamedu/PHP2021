<?php

namespace Elastic\Models;

use Elastic\Models\Contracts\Model;

class Video implements Model
{
    public ?string $id;
    public ?string $channelId;
    public ?string $name;
    public ?string $description;
    public ?int $numberOfLikes;
    public ?int $numberOfDislikes;

    public const INDEX = 'video';
    public const SCHEMA = [
        'index' => self::INDEX,
        'body' => [
            'mappings' => [
                'properties' => [
                    'channel_id' => [
                        'type' => 'text',
                        'analyzer' => 'keyword',
                        'fielddata' => true,
                    ],
                    'name' => [
                        'type' => 'text',
                    ],
                    'description' => [
                        'type' => 'text',
                    ],
                    'numberOfLikes' => [
                        'type' => 'integer',
                    ],
                    'numberOfDislikes' => [
                        'type' => 'integer'
                    ],
                ],
            ],
        ],
    ];

    public function __construct(array $videoData)
    {
        $this->id = $videoData['id'] ?? null;
        $this->channelId = $videoData['channel_id'] ?? null;
        $this->name = $videoData['name'] ?: null;
        $this->description = $videoData['description'] ?? null;
        $this->numberOfLikes = $videoData['number_of_likes'] ?? null;
        $this->numberOfDislikes = $videoData['number_of_dislikes'] ?? null;
    }
}
