<?php

namespace App\Http\Controllers;

use App\Repositories\ElasticSearchRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatisticController extends Controller
{
    private $elasticSearchRepository;

    public function __construct(ElasticSearchRepository $elasticSearchRepository) {
        $this->elasticSearchRepository = $elasticSearchRepository;
    }

    public function sum(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(),400);
        }
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
dd($videos = $this->elasticSearchRepository->searchTop());
    }
}
