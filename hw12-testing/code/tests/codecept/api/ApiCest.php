<?php

//namespace codecept;

//use Codeception\Stub;
use Codeception\Stub;
use integration\Repetitor202\DummyOrderRepository;
use Repetitor202\controllers\PaymentController;
use Repetitor202\repositories\IOrderRepository;
use Repetitor202\repositories\OrderRepository;


class ApiCest
{
    use Codeception\Test\Feature\Stub;

//    public function tryApi(ApiTester $I)
//    {
//        $I->sendGet('/');
//        $I->seeResponseCodeIs(200);
//        $I->seeResponseIsJson();
//    }
//
//    public function tryApi2(ApiTester $I)
//    {
//        $I->sendPost('/make-payment');
//        $I->seeResponseCodeIs(400);
//        $I->seeResponseIsJson();
//    }
//
////    public function tryApi3(ApiTester $I)
////    {
////        $I->sendPost('make-payment', json_encode([
////            'card_holder' => 'Ivan Ivanov-Petrov',
////            'card_number' => '1234567890123456',
////            'card_expiration' => '12/22',
////            'cvv' => '123',
////            'order_number' => 'order-123',
////            'sum' => '123.40',
////        ]));
////        $I->seeResponseCodeIs(200);
//////        $I->seeResponseIsJson();
////    }

//    public function tryApi4(ApiTester $I, $scenario)
    public function tryApi4(ApiTester $I)
//    public function tryApi4()
    {
//        $scenario->skip('your message');


//        $repository = $this->make(IOrderRepository::class );
//        $repository->method('setOrderIsPaid')->willReturn(true);


//        $repository = Codeception\Stub::makeEmpty(IOrderRepository::class);
//        $repository = $this->make(IOrderRepository::class, [
//            'setOrderIsPaid' => Codeception\Stub\Expected::once()
//        ]);
//        $repository = $this->makeEmpty(IOrderRepository::class );
//        $repository = Codeception\Stub::make(IOrderRepository::class);
//        $repository->method('setOrderIsPaid')->with('123', 123.08)->willReturn(true);

//        $controller = Codeception\Stub::make(PaymentController::class, [
////            'repository' => new \integration\Repetitor202\DummyOrderRepository(),
////            'repository' => DummyOrderRepository::class,
////            'repository' => new DummyOrderRepository(),
////            'repository' => Codeception\Stub::make(DummyOrderRepository::class),
////            'repository' => Codeception\Stub::makeEmpty(IOrderRepository::class),
//            'repository' => $repository,
//        ]);

//        Stub::make('IOrderRepository', ['setOrderIsPaid' => function () { return true; }]);
//        $this->makeEmpty(IOrderRepository::class, ['setOrderIsPaid' => function () { return true; }]);



//        $repository = $this->makeEmptyExcept(IOrderRepository::class, 'setOrderIsPaid');
//        $repository->method('setOrderIsPaid')->with('123', 123.08)->willReturn(true);
//        $repository->method('setOrderIsPaid')->with('123', 123.08)->willReturn(true);

//        Stub::construct(IOrderRepository::class, [], ['setOrderIsPaid' => function () { return true; }]);
//        Stub::make(OrderRepository::class, [], ['setOrderIsPaid' => function () { return true; }]);
//        Stub::construct(OrderRepository::class, [], ['setOrderIsPaid' => function () { return true; }]);
//        Stub::make(OrderRepository::class, ['setOrderIsPaid' => function () { return true; }], $this);

//        Mockery::mock();

        $this->cre(OrderRepository::class, ['setOrderIsPaid' => function () { return true; }]);


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