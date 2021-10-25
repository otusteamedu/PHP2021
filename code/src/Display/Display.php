<?php

namespace Display;

class Display
{
    public function outputResult($statistics)
    {
        foreach ($statistics as $statistic) {
            echo "Id канала: " . $statistic['statistics']['id_channel'] . "\n";
            echo "Рейтинг канала: " . round($statistic['rating'], 2) . "\n";
            echo "Количество просмотров: " . $statistic['statistics']['all_view_count'] . "\n";
            echo "Количество подписчиков: " . $statistic['statistics']['subscriber_count'] . "\n";
            echo "Количество лайков: " . $statistic['statistics']['all_like_count'] . "\n";
            echo "Количество дизлайков: " . $statistic['statistics']['all_dislike_count'] . "\n\n";
        }
    }
}
