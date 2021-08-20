<?php

namespace Repetitor202\controllers;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Repetitor202\facades\AFacade;
use Repetitor202\repositories\OrderRepository;
use Repetitor202\responses\JsonResponse;
use Repetitor202\validators\payment\IMakePaymentValidator;
use Repetitor202\validators\payment\MakePaymentValidator;

class PaymentController
{
    private IMakePaymentValidator $validator;

    public function makePayment(ServerRequestInterface $request): Response
    {
        $params = json_decode($request->getBody()->getContents(), true);

        $this->validator = new MakePaymentValidator();

        $validatorResult = $this->validator->validate($params);
        if (! $validatorResult->getIsValid()) {
            return JsonResponse::resposeWithStatus(400, ['message' => $validatorResult->getMessage()]);
        }

        $responseAFacade = (new AFacade())->pay($params);
        $statusCode = $responseAFacade->getStatus();
        if ($statusCode === 200) {
            $repository = new OrderRepository();
            if ($repository->setOrderIsPaid($params['order_number'], $params['sum'])) {
                return JsonResponse::resposeWithStatus(200);
            }
        } elseif ($statusCode === 403) {
            return JsonResponse::resposeWithStatus(403, ['message' => $responseAFacade->getMessage()]);
        }

        return JsonResponse::resposeWithStatus(500, ['message' => 'Internal Error']);
    }
}