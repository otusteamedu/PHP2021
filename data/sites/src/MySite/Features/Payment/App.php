<?php

declare(strict_types=1);

namespace MySite\Features\Payment;

use MySite\Features\Payment\Dto\CardData;
use MySite\Features\Payment\Services\PaymentService;
use MySite\Http\HttpCodes;
use MySite\Http\Request;
use MySite\Http\Response;
use Throwable;

/**
 * Class App
 * @package MySite\Features\Payment
 */
class App implements HttpCodes
{

    /**
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function run(Request $request): Response
    {
        $response = new Response();
        $post = $request->getParsedBody();

        $cardData = json_decode(
            $post['data'],
            true,
            flags: JSON_THROW_ON_ERROR
        );

        $cardDto = CardData::createFromArray($cardData);

        $paymentService = new PaymentService();
        $paymentService->validate($cardDto);


        if (!$cardDto->isValid()) {
            $response->withStatus(self::BAD_REQUEST, $cardDto->getMessage());
            return $response;
        }

        if (!$paymentService->pushPayment($cardDto)) {
            $response->withStatus(self::FORBIDDEN, $cardDto->getMessage());
            return $response;
        }

        if (!$paymentService->savePayment($cardDto)) {
            $response->withStatus(self::FORBIDDEN, $cardDto->getMessage());
            return $response;
        }

        $response->withStatus(self::OK, 'OK');
        $response->withBody(
            json_encode(
                [
                    'success' => true,
                    'message' => 'Payment is complete'
                ]
            )
        );

        return $response;
    }
}
