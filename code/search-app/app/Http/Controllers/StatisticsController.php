<?php

namespace App\Http\Controllers;

use App\Services\Youtube\StatisticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class StatisticsController extends Controller
{

    private StatisticsService $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function index(Request $request)
    {
        $query = $request->get('query') ?? '';
        $requestType = $request->get('type') ?? '';
        $data = $this->statisticsService->getResult($query, $requestType);
        $titles = $this->statisticsService->getTitles($requestType);

        View::share([
            'rows' => $data,
            'titles' => $titles,
        ]);

        return view('statistics.index');
    }

}
