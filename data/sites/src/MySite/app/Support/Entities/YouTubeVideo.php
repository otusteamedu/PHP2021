<?php

declare(strict_types=1);

namespace MySite\app\Support\Entities;

use MySite\app\Support\Definitions\YouTubeVideoDefinition;

/**
 * Class YouTubeVideo
 * @package MySite\app\Services\YouTubeParser
 */
final class YouTubeVideo
{
    use YouTubeVideoDefinition;

    /**
     * YouTubeChannel Constructor.
     * @param string $id
     */
    public function __construct(
        private string $id
    ) {
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function title(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function description(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function publishedAt(): ?string
    {
        return $this->publishedAt;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $channelId
     * @return $this
     */
    public function setChannelId(string $channelId): self
    {
        $this->channelId = $channelId;
        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $publishedAt
     * @return $this
     */
    public function setPublishedAt(string $publishedAt): self
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * @return int
     */
    public function likes(): int
    {
        return $this->likes;
    }

    /**
     * @return int
     */
    public function dislikes(): int
    {
        return $this->dislikes;
    }

    /**
     * @param int $val
     * @return $this
     */
    public function addLikes(int $val): self
    {
        $this->likes += $val;
        return $this;
    }

    /**
     * @param int $val
     * @return $this
     */
    public function addDislikes(int $val): self
    {
        $this->dislikes += $val;
        return $this;
    }

    /**
     * @return string
     */
    public function channelId(): string
    {
        return $this->channelId;
    }
}
