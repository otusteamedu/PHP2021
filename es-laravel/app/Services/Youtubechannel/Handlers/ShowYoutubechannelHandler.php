<?php

namespace App\Services\Youtubechannel\Handlers;


use App\Models\Youtubechannel;
use App\Services\Youtubechannel\Repositories\SearchYoutubechannelRepository;

class ShowYoutubechannelHandler
{

    private ViewsYoutubechannelRepository $viewsYoutubechannelRepository;
    private CacheYoutubechannelRepository $cacheYoutubechannelRepository;

    public function __construct(
        ViewsYoutubechannelRepository $viewsYoutubechannelRepository,
        CacheYoutubechannelRepository $cacheYoutubechannelRepository
    )
    {

        $this->viewsYoutubechannelRepository = $viewsYoutubechannelRepository;
        $this->cacheYoutubechannelRepository = $cacheYoutubechannelRepository;
    }

    public function handle(int $id, string $userKey): ?Youtubechannel
    {
        $youtubechannel = $this->cacheYoutubechannelRepository->find($id);
        if (!$youtubechannel) {
            return null;
        }

        $this->viewsYoutubechannelRepository->incViewsCount($id, $userKey);
        return $youtubechannel;
    }

}
