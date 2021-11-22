<?php

declare(strict_types=1);

namespace MySite\app\Support\Definitions;


use MySite\app\Support\Entities\YouTubeChannel;
use MySite\app\Support\Entities\YouTubeVideo;

/**
 * Trait GrabberDefinition
 * @package MySite\app\Services\YouTubeParser\Traits\
 */
trait GrabberDefinition
{
    /**
     * @var YouTubeChannel
     */
    protected YouTubeChannel $channel;

    /**
     * @var YouTubeVideo
     */
    protected YouTubeVideo $video;

    /**
     * @param YouTubeChannel $channel
     * @return $this
     */
    public function setChannel(YouTubeChannel $channel): static
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * @param YouTubeVideo $video
     * @return $this
     */
    public function setVideo(YouTubeVideo $video): static
    {
        $this->video = $video;
        return $this;
    }
}
