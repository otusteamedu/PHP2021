<?php

declare(strict_types=1);

namespace MySite\app\Support\Definitions;

use MySite\app\Support\Entities\YouTubeVideo;

/**
 * Trait YouTubeDefinition
 * @package MySite\app\Services\YouTubeParser\Traits
 */
trait YouTubeChannelDefinition
{
    /**
     * @var string|null
     */
    private ?string $title = null;

    /**
     * @var string|null
     */
    private ?string $description = null;

    /**
     * @var string|null
     */
    private ?string $publishedAt = null;

    /**
     * @var int
     */
    private int $likes = 0;

    /**
     * @var int
     */
    private int $dislikes = 0;

    /**
     * @var YouTubeVideo[]
     */
    private array $videos = [];
}
