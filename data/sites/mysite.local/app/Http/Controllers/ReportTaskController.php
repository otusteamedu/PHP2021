<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Validators\ReportTaskValidator;
use App\Responses\ReportTaskGetResponse;
use App\Services\ReportTask\ReportTaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Responses\ReportTaskPostResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ReportTaskController
 * @package App\Http\Controllers
 */
class ReportTaskController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $reportTaskTransfer = (new ReportTaskValidator())->validate($request);

        $reportTaskId = (new ReportTaskService())->store($reportTaskTransfer);

        return response()->json(
            new ReportTaskPostResponse($reportTaskId)
        );
    }

    /**
     * @param int $reportTaskId
     * @return JsonResponse
     */
    public function show(int $reportTaskId): JsonResponse
    {
        $reportTaskObject = (new ReportTaskService())->getByReportTaskId($reportTaskId);

        if ($reportTaskObject) {
            $reportTaskResponse = new ReportTaskGetResponse(
                $reportTaskObject->id,
                $reportTaskObject->reportStatus->name,
                $reportTaskObject->created_at
            );
        } else {
            throw new NotFoundHttpException();
        }

        return response()->json($reportTaskResponse);
    }
}
