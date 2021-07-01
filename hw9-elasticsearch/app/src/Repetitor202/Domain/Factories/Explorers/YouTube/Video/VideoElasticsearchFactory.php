<?php


namespace Repetitor202\Domain\Factories\Explorers\YouTube\Video;


use Repetitor202\Application\Clients\SQL\ElasticsearchQuery;
use Repetitor202\Domain\ActiveRecords\Explorers\YouTube\VideoActiveRecord;
use Repetitor202\Domain\Entities\Explorers\YouTube\VideoSource;

class VideoElasticsearchFactory extends VideoFactory
{

    public function getVideos(array $params = []): ?array
    {
        $videos = ElasticsearchQuery::selectItems(VideoActiveRecord::TABLE, $params);

        if(is_null($videos)) {
            return null;
        }

        $list = [];
        foreach ($videos['hits']['hits'] as $video) {
            $videoSource = new VideoSource($video['_source'], $video['_id']);

            $item = [
                'id' => $videoSource->getId(),
                'channelId' => $videoSource->getChannelId(),
                'likeCount' => $videoSource->getLikeCount(),
                'dislikeCount' => $videoSource->getDislikeCount(),
                'title' => $videoSource->getTitle(),
            ];
            $list[] = $item;
        }

        return $list;
    }

    public function deleteVideos(array $params): bool
    {
        return ElasticsearchQuery::deleteByParams(VideoActiveRecord::TABLE, $params);
    }
}