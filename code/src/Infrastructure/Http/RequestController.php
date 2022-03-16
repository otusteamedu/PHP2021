<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\Input\CreateRequestDto;
use App\Application\Service\RequestService;
use App\Domain\Contract\RequestServiceInterface;


class RequestController
{
    //создать новый запрос
    //Получить запрос по ид
    //Получить список всех запросов?

    private RequestServiceInterface $requestService;

    public function  __construct(RequestServiceInterface $requestService){
        $this->requestService = $requestService;

    }

    public function actionIndex(){
        echo '134';
    }

    /*
     * @Rest\GET("/api/v1/requests/{$id}")
     */
    public function actionView(array $param):void
    {
        $idRequest = (int)$param['id'];

        $responseDto = $this->requestService->getStatus($idRequest);
        //чтение очереди
        //$getStatus = $responseDto->status;
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

        //В очередь!
        http_response_code(201);
        echo json_encode($responseDto);

    }


    public function actionUpdate()
    {
        echo '4';
    }


}