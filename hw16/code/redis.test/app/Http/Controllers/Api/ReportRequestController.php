<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Report;
use App\Services\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 *     @OA\SecurityScheme(
 *         securityScheme="token",
 *         type="apiKey",
 *         name="Authorization",
 *         in="header"
 *     )
 *
 */

final class ReportRequestController extends Controller
{

    public function __construct(
        private Report $reportService,
        private View   $viewService
    )
    {
    }

    /**
     *
     * Create Report Request.
     *
     * @OA\Post(
     *     path="/api/report",
     *     security={{"token": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="priority", example="10"),
     *                 @OA\Property(property="conditions", example="{ 'param1': 1 }"),
     *                 @OA\Property(property="event", example="event2233"),
     *                 @OA\Property(property="replyType", example="email"),
     *                 @OA\Property(property="replyTo", example="you_email@you_email_host.test"),
     *                 @OA\Property(property="subject", example="testtest")
     *             )
     *         )
     *     ),
     *
     *  @OA\Response(response="200", description="OK", @OA\JsonContent()),
     *  @OA\Response(response="default", description="Error", @OA\JsonContent()),
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $requestData = $request->post();

        $result = $this->reportService->request($requestData);

        return $this->viewService->apiAnswer($result);
    }

    /**
     *
     * Get report data by request ID.
     *
     * @OA\Get(
     *     path="/api/report/{id}",
     *     security={{"token": {}}},
     *     @OA\Parameter(name="id", in="path", description="Request id", example="aa0ac453-a796-4b8b-9154-e06b75e065ce", required=true),
     *     @OA\Response(response="200", description="OK", @OA\JsonContent()),
     *     @OA\Response(response="default", description="Error", @OA\JsonContent()),
     * )
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $result = $this->reportService->getData($id);
        return $this->viewService->apiAnswer($result);
    }

    /**
     *
     * Get report request status by Request ID.
     *
     * @OA\Get(
     *     path="/api/report/status/{id}",
     *     security={{"token": {}}},
     *     @OA\Parameter(name="id", in="path", description="Request id", example="aa0ac453-a796-4b8b-9154-e06b75e065ce", required=true),
     *     @OA\Response(response="200", description="OK", @OA\JsonContent()),
     *     @OA\Response(response="default", description="Error", @OA\JsonContent()),
     * )
     *
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function getStatus(Request $request, string $id): JsonResponse
    {
        $result = $this->reportService->getStatus($id);
        return $this->viewService->apiAnswer($result);
    }

}
