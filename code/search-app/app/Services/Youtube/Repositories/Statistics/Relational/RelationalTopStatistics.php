<?php

namespace App\Services\Youtube\Repositories\Statistics\Relational;

use App\Services\Youtube\Repositories\Statistics\TopStatistics;
use Illuminate\Support\Facades\DB;

final class RelationalTopStatistics implements TopStatistics
{

    public function get(int $limit = 1): array
    {
        return DB::table('channels')
            ->join('videos', 'channels.id', '=', 'videos.channel_id')
            ->select(
                'channels.id',
                DB::raw('channels.name as title'),
                DB::raw('SUM(videos.likes)/SUM(videos.dislikes) as value')
            )
            ->groupBy('channels.id')
            ->orderByDesc('value')
            ->limit($limit)
            ->get()->toArray();
    }
}
