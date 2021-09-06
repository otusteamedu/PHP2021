<?php

//namespace codecept;

use integration\Repetitor202\DummyOrderRepository;
use Repetitor202\controllers\PaymentController;
use Repetitor202\repositories\IOrderRepository;

class ApiCest
{    
    public function tryApi(ApiTester $I)
    {
        $I->sendGet('/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    public function tryApi2(ApiTester $I)
    {
        $I->sendPost('/make-payment');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

//    public function tryApi3(ApiTester $I)
//    {
//        $I->sendPost('make-payment', json_encode([
//            'card_holder' => 'Ivan Ivanov-Petrov',
//            'card_number' => '1234567890123456',
//            'card_expiration' => '12/22',
//            'cvv' => '123',
//            'order_number' => 'order-123',
//            'sum' => '123.40',
//        ]));
//        $I->seeResponseCodeIs(200);
////        $I->seeResponseIsJson();
//    }

    public function tryApi4(ApiTester $I, $scenario)
    {
        $scenario->skip('your message');
        $repository = Codeception\Stub::makeEmpty(IOrderRepository::class);
        $repository->method('setOrderIsPaid')->willReturn(true);

        $controller = Codeception\Stub::make(PaymentController::class, [
//            'repository' => new \integration\Repetitor202\DummyOrderRepository(),
//            'repository' => DummyOrderRepository::class,
//            'repository' => new DummyOrderRepository(),
//            'repository' => Codeception\Stub::make(DummyOrderRepository::class),
//            'repository' => Codeception\Stub::makeEmpty(IOrderRepository::class),
            'repository' => $repository,
        ]);


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