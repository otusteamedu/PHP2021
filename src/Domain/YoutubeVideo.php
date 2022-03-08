<?php

namespace App\Domain;

class YoutubeVideo
{
    public const NAME = 'youtube_video';

    private string $id;
    private string $title;
    private int $viewCount;
    private int $likeCount;

    /**
     * @param array $item
     */
    public function __construct(array $item)
    {
        $this->id = $item['id'];
        $this->title = $item['title'];
        $this->viewCount = $item['view_count'];
        $this->likeCount = $item['like_count'];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'view_count' => $this->viewCount,
            'like_count' => $this->likeCount,
        ];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    /**
     * @return int
     */
    public function getLikeCount(): int
    {
        return $this->likeCount;
    }
}
