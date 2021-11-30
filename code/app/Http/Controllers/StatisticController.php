<?php

namespace App\Http\Controllers;

use App\Repositories\ElasticSearchRepository;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    private $elasticSearchRepository;

    public function __construct(ElasticSearchRepository $elasticSearchRepository) {
        $this->elasticSearchRepository = $elasticSearchRepository;
    }

    public function sumOfLikesAndDislikes(Request $request)
    {
        $videos = $this->elasticSearchRepository->search($request->get('name'));
        $likesSum = $videos->sum(function ($video) {
            return $video['likes'];
        });
        $dislikesSum = $videos->sum(function ($video) {
            return $video['dislikes'];
        });
        return [
            'likes' => $likesSum,
            'dislikes' => $dislikesSum,
        ];
    }

    public function bestChannels()
    {
dd($videos = $this->elasticSearchRepository->search());
    }
}
