<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Report;
use App\Services\View;
use Illuminate\Http\Request;


final class ReportController extends Controller
{

    public function __construct(private Report $reportService, private View $viewService)
    {
    }

    public function request(Request $request)
    {

        $requestData = $request->post();

        $result = $this->reportService->request($requestData);

        $this->viewService->apiAnswer($result);

    }



}
