<?php

declare(strict_types=1);

namespace MySite\app\Support\Definitions;

/**
 * Trait YouTubeVideoDefinition
 * @package MySite\app\Support\Definitions
 */
trait YouTubeVideoDefinition
{
    /**
     * @var string|null
     */
    private ?string $channelId = null;

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

}
