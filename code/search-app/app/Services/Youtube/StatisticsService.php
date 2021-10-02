<?php

namespace App\Services\Youtube;

use App\Services\Youtube\Repositories\Statistics\ChannelStatistics;
use App\Services\Youtube\Repositories\Statistics\TopStatistics;
use App\Services\Youtube\Structures\Titles;

final class StatisticsService
{

    private ChannelStatistics $channelStatisticsRepository;
    private TopStatistics $topStatisticsRepository;

    public function __construct(ChannelStatistics $channelStatisticsRepository, TopStatistics $topStatisticsRepository)
    {
        $this->channelStatisticsRepository = $channelStatisticsRepository;
        $this->topStatisticsRepository = $topStatisticsRepository;
    }

    public function getResult(string $query, string $type): array
    {
        switch ($type) {
            case 'sum':
                return $this->channelStatisticsRepository->get($query);
            case 'top':
                $limit = is_numeric($query) && $query > 0 ? (int)$query : 1;
                return $this->topStatisticsRepository->get($limit);
            default:
                return [];
        }
    }

    public function getTitles(string $type): Titles
    {
        switch ($type) {
            case 'sum':
                return new Titles('Канал', 'Кол-во лайков/дизлайков');
            case 'top':
                return new Titles('Канал', 'Соотношение лайки/дизлайки');
            default:
                return new Titles('-', '-');
        }

    }

}
