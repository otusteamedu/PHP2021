<?php


namespace Repetitor202\Application\Clients\Explorers\YouTube;


use Exception;
use Repetitor202\Application\traits\RequestTrait;
use Repetitor202\Domain\ActiveRecords\Explorers\YouTube\VideoActiveRecord;

class YouTubeClient
{
    use RequestTrait;

    private const BASE_URL = 'https://www.googleapis.com/youtube/v3';

    public function getChannel(string $id): array
    {
        $videos = [];
        $counter = 1;

        do {
            $channelApi = $this->searchChannelApi(
                $id,
                $channelApi['nextPageToken'] ?? null
            );

            echo $counter++ . ') nextPageToken - ' . $channelApi['nextPageToken'] . PHP_EOL;

            $videoIDs = '';

            foreach ($channelApi['items'] as $item) {
                if (isset($item['id']) && isset($item['id']['videoId'])) {
                    $videoIDs .= $item['id']['videoId'] . ',';

                    // TODO: get channelTitle
                    $title = $item['snippet']['channelTitle'];
                }
            }

            $videos = array_merge($videos, $this->getVideos($videoIDs));
        } while (! is_null($channelApi['nextPageToken']));

        return [
            'id' => $id,
            'title' => $title ?? '',
            'videos' => $videos,
        ];
    }

    public function getVideos(string $videoIDs): array
    {
        $videosApi = $this->getVideosApi($videoIDs);

        $videos = [];
        foreach ($videosApi['items'] as $videoApi) {
            $videos[] = (new VideoActiveRecord())->doMappingApi($videoApi);
        }

        return $videos;
    }

    private function searchChannelApi(string $channelId, string $nextPageToken = null): ?array
    {
        $url = self::BASE_URL . '/search'
            . '?key=' . $_ENV['YOUTUBE_API_KEY']
            . '&channelId=' . trim($channelId)
            . '&part=id,snippet'
            . '&order=date'
            . '&maxResults=20';

        if (! is_null($nextPageToken)) {
            $url .= '&pageToken=' . $nextPageToken;
        }

        $channel = $this->sendRequest('GET', $url);

        if(is_null($channel) || is_null($channel['items'])) {
            // TODO: write to log
            throw new Exception('Bad request.');
        }

        return $channel;
    }

    private function getVideosApi(string $videoIDs): array
    {
        $url = self::BASE_URL . '/videos'
            . '?key=' . $_ENV['YOUTUBE_API_KEY']
            . '&part=snippet,statistics'
            . '&id=' . trim($videoIDs);

        $videos = $this->sendRequest('GET', $url);

        if(is_null($videos) || is_null($videos['items'])) {
            // TODO: write to log
            throw new Exception('Bad request.');
        }

        return $videos;
    }
}