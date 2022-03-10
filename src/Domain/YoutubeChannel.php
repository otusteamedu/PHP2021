<?php

namespace App\Domain;

class YoutubeChannel
{
    public const NAME = 'youtube_channel';

    private string $id;

    private string $title;

    /**
     * @var YoutubeVideo[]
     */
    private array $videos;

    /**
     * @param array $item
     */
    public function __construct(array $item)
    {
        $this->id = $item['id'];
        $this->title = $item['title'];
        $this->videos = array_map(
            fn($video) => new YoutubeVideo($video),
            $item['videos']
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'     => $this->id,
            'title'  => $this->title,
            'videos' => array_map(fn($v) => $v->toArray(), $this->videos),
        ];
    }

    /**
     * @param YoutubeVideo $video
     *
     * @return YoutubeChannel
     */
    public function addVideo(YoutubeVideo $video): YoutubeChannel
    {
        $this->videos[] = $video;

        return $this;
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
     * @return YoutubeVideo[]
     */
    public function getVideos(): array
    {
        return $this->videos;
    }
}
