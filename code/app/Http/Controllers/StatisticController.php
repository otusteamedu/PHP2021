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
        dd($this->elasticSearchRepository->search($request->get('name')));
    }
}
