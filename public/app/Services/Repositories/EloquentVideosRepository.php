<?php

namespace App\Services\Repositories;

use App\Models\Videos;
use Illuminate\Support\Collection;

class EloquentVideosRepository implements VideosRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Videos::query()->get();
    }
}
