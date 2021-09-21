<?php

namespace App\Services\Youtube\Repositories\Statistics;


interface ChannelStatistics
{
    public function get(string $query = ''): array;
}
