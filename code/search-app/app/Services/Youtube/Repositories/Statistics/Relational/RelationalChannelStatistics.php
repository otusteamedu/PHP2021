<?php

namespace App\Services\Youtube\Repositories\Statistics\Relational;

use App\Services\Youtube\Repositories\Statistics\ChannelStatistics;
use Illuminate\Support\Facades\DB;

final class RelationalChannelStatistics implements ChannelStatistics
{

    public function get(string $query = ''): array
    {
        return DB::table('channels')
            ->join('videos', 'channels.id', '=', 'videos.channel_id')
            ->select(
                'channels.id',
                DB::raw('channels.name as title'),
                DB::raw('CONCAT(SUM(videos.likes), " / ", SUM(videos.dislikes)) as value')
            )
            ->where('channels.name', 'like', "%$query%")
            ->groupBy('channels.id')
            ->get()->toArray();
    }
}
