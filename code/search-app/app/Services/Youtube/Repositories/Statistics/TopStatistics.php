<?php

namespace App\Services\Youtube\Repositories\Statistics;


interface TopStatistics
{
    public function get(int $limit = 0): array;
}
