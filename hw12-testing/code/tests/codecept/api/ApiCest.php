<?php

namespace CodeceptApi;

use ApiTester;

class ApiCest
{
    public function testValidParams(ApiTester $I, $scenario)
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

    public function testUnvalidParams(ApiTester $I)
    {
        $I->sendPost('make-payment', json_encode([
            'card_holder' => 'Ivan Ivanov-Petrov',
            'card_number' => '123', // unvalid param
            'card_expiration' => '12/22',
            'cvv' => '123',
            'order_number' => 'order-123',
            'sum' => '123.40',
        ]));

        $I->seeResponseCodeIs(400);
    }
}