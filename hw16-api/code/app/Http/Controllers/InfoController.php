<?php

namespace App\Http\Controllers;

use App\Jobs\InfoCreatedJob;
use App\Models\Info;
use App\Repositories\Info\IInfoRepository;
use App\Repositories\Info\InfoEloquentRepository;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    private IInfoRepository $repository;
    private Info $info;

    public function __construct(InfoEloquentRepository $eloquentRepository)
    {
        $this->repository = $eloquentRepository;
    }

    /**
     * Create info.
     *
     * @OA\Post(
     *     path="/info",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="message", example="swagger-message")
     *             )
     *         )
     *     ),
     *
     *  @OA\Response(response="200", description="OK", @OA\JsonContent()),
     *  @OA\Response(response="default", description="Error", @OA\JsonContent()),
     * )
     */
    public function create(Request $request): int
    {
        // todo: validation - is message in request
        $message = json_decode($request->getContent(), true)['message'];
        $this->info = $this->repository->create($message);
        dispatch(new InfoCreatedJob($this->info));

        return $this->info->id;
    }

    /**
     * Get status.
     *
     * @OA\Get(
     *     path="/info/{id}/status",
     *     @OA\Parameter(name="id", in="path", description="The identifier of info.", example=1, required=true),
     *     @OA\Response(response="200", description="OK"),
     * )
     */
    public function getStatus(int $id): string
    {
        $this->info = $this->repository->getById($id);

        return $this->info->status;
    }
}
