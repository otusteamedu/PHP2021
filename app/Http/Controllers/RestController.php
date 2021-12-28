<?php

namespace App\Http\Controllers;

use App\Jobs\RestRequestJob;
use App\Models\RestRequest;
use Illuminate\Contracts\Bus\Dispatcher;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\MediaType;
use OpenApi\Annotations\Post;
use OpenApi\Annotations\RequestBody;
use OpenApi\Annotations\Response;

class RestController
{
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
    public function request(RestRequestJob $job): string
    {
        $restRequest = RestRequest::create(['status' => 'Принято в обработку']);

        $job->setId($restRequest->id);

        try {
            app(Dispatcher::class)->dispatch($job);
        } catch (\Exception $e) {
            return 'Ошибка ' . $e->getMessage();
        }

        return 'Запрос отправлен. Номер запроса ' . $restRequest->id;

    }

    /**
     * @Get(
     *     path="/getstatus/{id}",
     *     summary="Проверить статус запроса",
     *     @Parameter(name="id", in="path", required=true),
     *     @Response(response="200", description="Successful")
     *
     *)
     */
    public function getStatus(int $id): string
    {
        $restStatus = RestRequest::find($id);

        return isset($restStatus) ? $restStatus->status : 'Запрос найден';
    }
}
