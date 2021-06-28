<?php


namespace Repetitor202\Domain\ActiveRecords\Explorers\YouTube;


use Exception;
use Repetitor202\Application\Clients\SQL\ElasticsearchQuery;
use Repetitor202\Application\Clients\SQL\MongoDbQuery;

class VideoActiveRecord
{
    public const TABLE = 'youtube_videos';
    private ?string $sqlClientClassname;

    private string $id;
    private string $channelId;
    private int $likeCount;
    private int $dislikeCount;
    private string $title;

    public function __construct()
    {
        switch ($_ENV['SQL_CLIENT']) {
            case ElasticsearchQuery::STORAGE_NAME:
                $this->sqlClientClassname = ElasticsearchQuery::class;
                break;
            case MongoDbQuery::STORAGE_NAME:
                $this->sqlClientClassname = MongoDbQuery::class;
                break;
            default:
                $this->sqlClientClassname = null;
        }
    }

    public function insert(): bool
    {
        return $this->sqlClientClassname::createOneItem(
            self::TABLE,
            [
                'channelId' => $this->getChannelId(),
                'likeCount' => $this->getLikeCount(),
                'dislikeCount' => $this->getDislikeCount(),
                'title' => $this->getTitle(),
            ],
            $this->getId()
        );
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
        return $this->dislikeCount;
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

    public function doMappingApi(array $videoApi): array
    {
        if(! $this->validateVideo($videoApi)) {
            // TODO: write to log
            throw new Exception('Incorrect answer from youTube.');
        }

        $video = [];
        $video['id'] = $videoApi['id'];
        $video['channelId'] = $videoApi['snippet']['channelId'];
        $video['title'] = $videoApi['snippet']['title'];
        $video['likeCount'] = $videoApi['statistics']['likeCount'];
        $video['dislikeCount'] = $videoApi['statistics']['dislikeCount'];

        return $video;
    }

    private function validateVideo(array $videoApi): bool
    {
        return !(
            is_null($videoApi['id']) ||
            is_null($videoApi['snippet']) ||
            is_null($videoApi['snippet']['channelId']) ||
            is_null($videoApi['snippet']['title']) ||
            is_null($videoApi['statistics']) ||
            is_null($videoApi['statistics']['likeCount']) ||
            is_null($videoApi['statistics']['dislikeCount'])
        );
    }
}