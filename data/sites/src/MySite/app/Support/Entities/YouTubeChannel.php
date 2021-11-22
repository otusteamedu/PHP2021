<?php

declare(strict_types=1);

namespace MySite\app\Support\Entities;


use MySite\app\Support\Definitions\YouTubeChannelDefinition;

final class YouTubeChannel
{
    use YouTubeChannelDefinition;

    /**
     * YouTubeChannel Constructor.
     * @param string $id
     */
    public function __construct(
        private string $id
    ) {
    }

    /**
     * @return float|int
     */
    public function likesAndDislikesRatio(): float|int
    {
        return ($this->dislikes)
            ? $this->likes / $this->dislikes
            : $this->likes;
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
     * @return YouTubeVideo[]
     */
    public function videos(): array
    {
        return $this->videos;
    }

    /**
     * @param YouTubeVideo $video
     * @return $this
     */
    public function addVideo(YouTubeVideo $video): self
    {
        $this->videos[$video->id()] = $video;
        return $this;
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

    public function __toString(): string
    {
        return
            'Канал ' . $this->title() . '<br />' .
            'Лайков = ' . $this->likes() . '<br />' .
            'Дизлайков = ' . $this->dislikes();
    }

    /**
     * @return string|null
     */
    public function title(): ?string
    {
        return $this->title;
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
}
