<?php

use App\Application\YoutubeAnalyticControllerInterface;
use App\Application\YoutubeAnalyticsServiceInterface;
use App\Application\YoutubeChannelControllerInterface;
use App\Application\YoutubeCrawlerInterface;
use App\Application\YoutubeEsRepositoryInterface;
use App\Infrastructure\YoutubeAnalyticController;
use App\Infrastructure\YoutubeAnalyticsService\YoutubeAnalyticsService;
use App\Infrastructure\YoutubeChannelController;
use App\Infrastructure\YoutubeCrawler;
use App\Infrastructure\YoutubeEsRepository\YoutubeEsRepository;
use Elasticsearch\ClientBuilder;

$esHost = sprintf('%s:%s', getenv('LOCAL_HOST'), getenv('ES_PORT'));
$esClient = ClientBuilder::create()
                         ->setHosts([$esHost])
                         ->build();

$googleConfig = [
    'application_name' => 'YoutubeApiProject',
    'developer_key'    => getenv("YOUTUBE_API_KEY"),
];
$googleClient = DI\create(Google\Client::class)->constructor($googleConfig);
$youtubeServiceHelper = DI\create(Google_Service_YouTube::class)->constructor($googleClient);

return [
    Elasticsearch\Client::class               => fn() => $esClient,
    Google_Service_YouTube::class             => $youtubeServiceHelper,
    YoutubeCrawlerInterface::class            => DI\get(YoutubeCrawler::class),
    YoutubeEsRepositoryInterface::class       => DI\get(YoutubeEsRepository::class),
    YoutubeAnalyticsServiceInterface::class   => DI\get(YoutubeAnalyticsService::class),
    YoutubeAnalyticControllerInterface::class => DI\get(YoutubeAnalyticController::class),
    YoutubeChannelControllerInterface::class  => DI\get(YoutubeChannelController::class),
];
