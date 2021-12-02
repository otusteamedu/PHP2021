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
        return $this->elasticSearchRepository->searchSumOfGrades($request->get('name'));
    }

    public function bestChannels(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response($validator->errors(),400);
        }
        return $this->elasticSearchRepository->searchTop($request->get('limit'));
    }
}
