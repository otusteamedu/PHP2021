<?php

namespace Repetitor202\controllers;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Repetitor202\decoders\ServerRequestDecoder;
use Repetitor202\facades\MoneyServiceAFacade;
use Repetitor202\repositories\IOrderRepository;
use Repetitor202\repositories\OrderRepository;
use Repetitor202\responses\JsonResponse;
use Repetitor202\validators\payment\IMakePaymentValidator;
use Repetitor202\validators\payment\MakePaymentValidator;

class PaymentController
{
    private IMakePaymentValidator $validator;
    private IOrderRepository $repository;
    private ServerRequestDecoder $decoder;

    public function __construct(OrderRepository $repository, MoneyServiceAFacade $moneyServiceAFacade)
    {
//        $this->decoder = new ServerRequestDecoder();
//        $this->validator = new MakePaymentValidator();
        $this->repository = $repository;
        $this->moneyServiceAFacade = $moneyServiceAFacade;
    }

    public function makePayment(ServerRequestInterface $request): Response
    {
        $params = $this->decoder->decodeParams($request);


//        $params = [
//            'card_holder' => 'Ivan Ivanov-Petrov',
//            'card_number' => '1234567890123456',
//            'card_expiration' => '12/22',
//            'cvv' => '123',
//            'order_number' => 'order-123',
//            'sum' => '123,40'
//        ];
        $params = $this->prepareSum($params);
//
////        $validatorResult = $this->validator->validate($params);
////        if (! $validatorResult->getIsValid()) {
////            return JsonResponse::resposeWithStatus(400, ['message' => $validatorResult->getMessage()]);
////        }
//
        $responseMoneyServiceAFacade = $this->moneyServiceAFacade->pay($params);
//        $statusCode = $responseMoneyServiceAFacade->getStatus();
        $statusCode = 200;
        if ($statusCode === 200) {
            if ($this->repository->setOrderIsPaid($params['order_number'], $params['sum'])) {
                return JsonResponse::resposeWithStatus(200);
            }
        } elseif ($statusCode === 403) {
            return JsonResponse::resposeWithStatus(403, [
                'message' => $responseMoneyServiceAFacade->getMessage(),
            ]);
        }

        return JsonResponse::resposeWithStatus(500, ['message' => 'Internal Error']);
    }

    private function prepareSum(?array $params): ?array
    {
        if (isset($params['sum'])) {
            $params['sum'] = (float) str_replace(',', '.', $params['sum']);
        }

        return $params;
    }
}