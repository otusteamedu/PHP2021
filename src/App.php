<?php

namespace App;

use App\Infrastructure\YoutubeAnalyticsService\YoutubeAnalyticsService;
use App\Infrastructure\YoutubeEsRepository\YoutubeEsRepository;
use DI\Container;
use DI\ContainerBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use Exception;

class App
{
    private Container $container;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->container =
            (new ContainerBuilder())->addDefinitions('config/config.php')
                                    ->build();
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        [$channel] = $this->getYoutubeChannels();

        $analyticService =
            $this->container->get(YoutubeAnalyticsService::class);
        $channelStats =
            $analyticService->getTotalLikesViewsByChannel($channel->getId());
        $topChannelsStats =
            $analyticService->getTopChannelsWithMaxLikesViewsPercentage(5);

        printf(
            'Total likes and views by channel <br /> %s<br /><br />',
            $channelStats
        );
        printf(
            'Top %s channels with max likes/views percentage <br /> %s',
            count($topChannelsStats),
            implode('<br />', $topChannelsStats)
        );
    }

    /**
     * @throws Exception
     */
    private function getYoutubeChannels(): array
    {
        $repository = $this->container->get(YoutubeEsRepository::class);
        try {
            $channels = $repository->getAll();
        } catch (Missing404Exception $e) {
            $repository->populate();
            $channels = $repository->getAll();
        }

        return $channels;
    }
}
