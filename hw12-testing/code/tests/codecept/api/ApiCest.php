<?php

namespace CodeceptApi;

use ApiTester;

class ApiCest
{
    public function tryApi4(ApiTester $I, $scenario)
    {
//        $scenario->skip('your message');

        $I->sendPost('make-payment', json_encode([
            'card_holder' => 'Ivan Ivanov-Petrov',
            'card_number' => '1234567890123456',
            'card_expiration' => '12/22',
            'cvv' => '123',
            'order_number' => 'order-123',
            'sum' => '123.40',
        ]));

        $I->seeResponseCodeIs(200);
    }
}