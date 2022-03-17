<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\Input\CreateRequestDto;
use App\Application\Output\RequestIsCreatedDto;
use App\Application\Service\RequestService;
use App\Domain\Contract\RequestServiceInterface;
use App\Infrastructure\Services\SendRabbitMQ;


class RequestController
{
    //создать новый запрос
    //Получить запрос по ид
    //Получить список всех запросов?

    private RequestServiceInterface $requestService;

    public function  __construct(RequestServiceInterface $requestService){
        $this->requestService = $requestService;

    }


    /*
     * @Rest\GET("/api/v1/requests")
     */
    public function actionIndex(){
        $responseDto = $this->requestService->findAllRequests();
        http_response_code(200);
        echo json_encode($responseDto);
    }

    /*
     * @Rest\GET("/api/v1/requests/{$id}")
     */
    public function actionView(array $param):void
    {

            $idRequest = (int)$param['id'];

            $responseDto = $this->requestService->getStatus($idRequest);

            http_response_code(200);
            echo json_encode($responseDto);

    }


    /*
     * @Rest\Post("/api/v1/requests")
     */
    public function actionCreate():void
    {

            $body = json_decode(file_get_contents('php://input'),true);

            $dto = CreateRequestDto::fromArray($body);
            $responseDto = $this->requestService->createRequest($dto);

            http_response_code(201);
            echo json_encode($responseDto);

            //В очередь!
            $messageBody = json_encode($responseDto);
            (new SendRabbitMQ())->execute($messageBody);

    }


    public function actionUpdate()
    {
        echo '4';
    }


}