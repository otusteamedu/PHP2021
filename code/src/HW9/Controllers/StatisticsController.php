<?php


namespace HW9\Controllers;

use HW9\Search\Channel\ChannelList as SearchChannelList;
use HW9\Search\Statistics\Channel as StatisticsChannel;
use HW9\Search\Statistics\Statistics;

class StatisticsController extends BaseController
{
    public function __construct()
    {
        $this->initSearch();
    }

    public function showAll() : void
    {
        $channel_list = new SearchChannelList();
        $channel_list->setClient($this->search->getClient());
        $channel_list->get();

        $channel_list = new SearchChannelList();
        $channel_list->setClient($this->search->getClient());
        $channel_list->get();

        $channel_stats = new StatisticsChannel();
        $channel_stats->setClient($this->search->getClient());

        foreach ($channel_list->items as $channel) {
            $sum = $channel_stats->getSum($channel->getId());
            $channel->setLikes($sum['likes']);
            $channel->setDislikes($sum['dislikes']);

            $channel_stats->show($channel);
        }
    }

    public function showTop() : void
    {
        $stat = new Statistics();
        $stat->setClient($this->search->getClient());

        if (!empty($argv[2])) {
            $stat->setLimit($argv[2]);
        }

        $top = $stat->top();
        $stat->showTop($top);
    }
}
