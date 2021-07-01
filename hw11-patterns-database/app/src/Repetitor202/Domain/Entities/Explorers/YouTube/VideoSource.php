<?php


namespace Repetitor202\Domain\Entities\Explorers\YouTube;


class VideoSource
{
    private string $id;
    private string $channelId;
    private int $likeCount;
    private int $dislikeCount;
    private string $title;

    public function __construct(
        array $source,
        string $id
    )
    {
        $this->channelId = $source['channelId'];
        $this->likeCount = $source['likeCount'];
        $this->dislikeCount = $source['dislikeCount'];
        $this->title = $source['title'];

        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getChannelId(): string
    {
        return $this->channelId;
    }

    public function setChannelId(string $channelId): void
    {
        $this->channelId = $channelId;
    }

    public function getLikeCount(): int
    {
        return $this->likeCount;
    }

    public function setLikeCount(int $likeCount): void
    {
        $this->likeCount = $likeCount;
    }

    public function getDislikeCount(): int
    {
        return $this->likeCount;
    }

    public function setDislikeCount(int $dislikeCount): void
    {
        $this->dislikeCount = $dislikeCount;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}