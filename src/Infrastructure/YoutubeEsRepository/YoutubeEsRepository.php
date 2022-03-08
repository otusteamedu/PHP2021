<?php

namespace App\Infrastructure\YoutubeEsRepository;

use App\Application\YoutubeCrawlerInterface;
use App\Application\YoutubeEsRepositoryInterface;
use App\Domain\YoutubeChannel;
use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Exception;

class YoutubeEsRepository implements YoutubeEsRepositoryInterface
{
    private const POPULATE_PARAMS = ['hitman', '/m/0bzvm2', 10, 50];

    private Client $client;
    private YoutubeCrawlerInterface $crawler;
    private array $mapping;

    /**
     * @throws Exception
     */
    public function __construct(
        Client $client,
        YoutubeCrawlerInterface $crawler
    ) {
        $this->client = $client;
        $this->crawler = $crawler;

        $mapping = json_decode(
            file_get_contents(__DIR__ . '/youtube_es_mapping.json'),
            true
        );
        if (is_null($mapping)) {
            throw new Exception('mapping is not found');
        }
        $this->mapping = $mapping;
    }

    public function search(array $statement): array
    {
        return $this->client->search([
                                         'index' => YoutubeChannel::NAME,
                                         'body'  => $statement,
                                     ]);
    }

    public function getAll(): array
    {
        $statement['query']['match_all'] = (object)[];
        $result = $this->search($statement);

        return array_map(
            fn($item) => new YoutubeChannel($item['_source']),
            $result['hits']['hits'] ?? []
        );
    }

    public function get(string $channelId): ?YoutubeChannel
    {
        try {
            $result = $this->client->get([
                                             'index' => YoutubeChannel::NAME,
                                             'id'    => $channelId,
                                         ]);
        } catch (Missing404Exception $e) {
            return null;
        }

        return new YoutubeChannel($result['_source']);
    }

    public function create(YoutubeChannel $channel): void
    {
        $this->mapIndex();

        $this->client->index([
                                 'index' => YoutubeChannel::NAME,
                                 'id'    => $channel->getId(),
                                 'body'  => $channel->toArray(),
                             ]);
    }

    public function delete(string $channelId): void
    {
        $this->client->delete([
                                  'index' => YoutubeChannel::NAME,
                                  'id'    => $channelId,
                              ]);
    }

    public function populate(): void
    {
        $channels =
            $this->crawler->getChannelsCollection(...self::POPULATE_PARAMS);

        array_walk($channels, fn($channel) => $this->create($channel));
    }

    public function clear(): void
    {
        $this->client->indices()
                     ->delete(['index' => YoutubeChannel::NAME]);
    }

    private function mapIndex(): void
    {
        try {
            $this->client->indices()
                         ->getMapping(['index' => YoutubeChannel::NAME]);
        } catch (Missing404Exception $e) {
            $this->client->indices()
                         ->create([
                                      'index' => YoutubeChannel::NAME,
                                      'body'  => $this->mapping,
                                  ]);
        }
    }
}
