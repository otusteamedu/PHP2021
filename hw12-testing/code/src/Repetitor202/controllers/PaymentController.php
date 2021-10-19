<?php

namespace Repetitor202\controllers;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Repetitor202\decoders\ServerRequestDecoder;
use Repetitor202\facades\MoneyServiceAFacade;
use Repetitor202\repositories\IOrderRepository;
use Repetitor202\repositories\OrderRepository;
use Repetitor202\responses\JsonResponse;
use Repetitor202\validators\payment\MakePaymentValidator;

class PaymentController
{
    private IOrderRepository $repository;
    private ServerRequestDecoder $decoder;

    public function __construct(
        ServerRequestDecoder $decoder,
        OrderRepository $repository,
        MoneyServiceAFacade $moneyServiceAFacade
    )
    {
        $this->decoder = $decoder;
        $this->repository = $repository;
        $this->moneyServiceAFacade = $moneyServiceAFacade;
    }

    public function makePayment(ServerRequestInterface $request): Response
    {
        $params = $this->decoder->decodeParams($request);
        $params = $this->prepareParamSum($params);

        $validator = new MakePaymentValidator();
        $validatorResult = $validator->validate($params);
        if (! $validatorResult->getIsValid()) {
            return JsonResponse::responseWithStatus(400, ['message' => $validatorResult->getMessage()]);
        }

        $responseMoneyServiceAFacade = $this->moneyServiceAFacade->pay($params);
        $statusCode = $responseMoneyServiceAFacade->getStatus();
        if ($statusCode === 200) {
            if ($this->repository->setOrderIsPaid($params['order_number'], $params['sum'])) {
                return JsonResponse::responseWithStatus(200);
            }
        } elseif ($statusCode === 403) {
            return JsonResponse::responseWithStatus(403, [
                'message' => $responseMoneyServiceAFacade->getMessage(),
            ]);
        }

        return JsonResponse::responseWithStatus(500, ['message' => 'Internal Error']);
    }

    private function prepareParamSum(?array $params): ?array
    {
        if (isset($params['sum'])) {
            $params['sum'] = (float) str_replace(',', '.', $params['sum']);
        }

        return $params;
    }
}