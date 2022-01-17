<?php

namespace App\Http\Controllers;

use App\Jobs\RestRequestInterface;
use App\Models\RestRequest;
use Illuminate\Contracts\Bus\Dispatcher;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\Post;
use OpenApi\Annotations\RequestBody;
use OpenApi\Annotations\Response;

class RestController
{
    private RestRequestInterface $job;

    public function __construct(RestRequestInterface $job)
    {
        $this->job = $job;
    }

    /**
     * @Post(
     *     path="/request",
     *     summary="Поставить запрос в обработку",
     *     @RequestBody(),
     *     @Response(
     *     response="200",
     *     description="Successful",
     * )
     * )
     */
    public function request(): string
    {
        $restRequest = RestRequest::create(['status' => 'Принято в обработку']);

        $this->job->setId($restRequest->id);

        try {
            app(Dispatcher::class)->dispatch($this->job);
        } catch (\Exception $e) {
            return response($e->getMessage(),500);
        }

        return response()->json(['id' => $restRequest->id]);

    }

    /**
     * @Get(
     *     path="/request/{id}",
     *     summary="Проверить статус запроса",
     *     @Parameter(name="id", in="path", required=true),
     *     @Response(response="200", description="Successful")
     *
     *)
     */
    public function getStatus(int $id): string
    {
        $restStatus = RestRequest::find($id);

        return isset($restStatus) ? $restStatus->status : response('',404);
    }
}
