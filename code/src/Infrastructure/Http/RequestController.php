<?php
declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\Input\CreateRequestDto;
use App\Domain\Contract\RequestServiceInterface;


class RequestController
{
    //создать новый запрос
    //Получить запрос по ид
    //Получить список всех запросов

    private RequestServiceInterface $requestService;

    public function  __construct(RequestServiceInterface $requestService){
        $this->requestService = $requestService;

    }


    /*
     * @Rest\GET("/api/v1/requests")
     */
    public function actionIndex(){
        $responseDto = $this->requestService->findAllRequests();

        if($responseDto==null){
            header('HTTP/1.1 400 There are no requests');
            throw new \Exception('Запросов нет!');;
        }

        header('HTTP/1.1 200 OK');
        echo json_encode($responseDto);
    }

    /*
     * @Rest\GET("/api/v1/requests/{$id}")
     */
    public function actionView(array $param):void
    {

            $idRequest = (int)$param['id'];

            $responseDto = $this->requestService->getStatus($idRequest);

            if($responseDto==null){
                header('HTTP/1.1 400 The request does not exist');
                throw new \Exception('Данный запрос отсутствует!');
            }

            header('HTTP/1.1 200 OK');
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

        header('HTTP/1.1 201 Request is created');
            echo json_encode($responseDto);

    }



}