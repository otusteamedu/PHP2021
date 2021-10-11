<?php

namespace Elastic\Models;

use Elastic\Models\Contracts\Model;

class Video implements Model
{
    private ?string $id;
    private ?string $channelId;
    private ?string $name;
    private ?string $description;
    private ?int $numberOfLikes;
    private ?int $numberOfDislikes;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChannelId(): ?int
    {
        return $this->channelId;
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

    public function getNumberOfLikes(): ?int
    {
        return $this->numberOfLikes;
    }

    public function setNumberOfLikes(int $numberOfLikes): void
    {
        $this->numberOfLikes = $numberOfLikes;
    }

    public function getNumberOfDislikes(): ?int
    {
        return $this->numberOfDislikes;
    }

    public function setNumberOfDislikes(int $numberOfDislikes): void
    {
        $this->numberOfDislikes = $numberOfDislikes;
    }
}
