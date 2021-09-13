<?php

namespace PhpUnit\integration;

use AppUnitTests\Repetitor202\validators\MakePaymentValidatorTestCase;
use GuzzleHttp\Client as GuzzleHttpClient;
use PHPUnit\Framework\TestCase;
use Repetitor202\dto\StatusMessageDto;
use Repetitor202\facades\MoneyServiceAFacade;
use Repetitor202\repositories\IOrderRepository;

// еще раз повторюсь, в моем понимании эти тесты автоматически проверяются в системных за счет проверки ->once,zero()

class FrontBackTestCase extends TestCase
{
//    private ?GuzzleHttpClient $http;
//
//    public function setUp(): void
//    {
//        $this->http = new GuzzleHttpClient(['base_uri' => 'http://unittests.hw/']);
//    }
//
//    public function tearDown(): void {
//        $this->http = null;
//    }
//
//    public function testSuccess()
//    {
//        static::markTestIncomplete('Недоделанный тест');
//        $params = MakePaymentValidatorTestCase::VALID_PARAMS;
//
//        $moneyStatusMessageDto = new StatusMessageDto();
//        $moneyStatusMessageDto->setStatus(200);
//        $this->mock(MoneyServiceAFacade::class, function (MockInterface $mock) use ($moneyStatusMessageDto) {
//            $mock->shouldReceive('pay')
////                ->once()
//                ->andReturn($moneyStatusMessageDto);
//        });
//
//        $this->mock(IOrderRepository::class, function (MockInterface $mock) {
//            $mock->shouldReceive('setOrderIsPaid')
//                ->andReturn(true);
//        });
//
//        $response = $this->http->request('POST', 'make-payment', ['json' => $params]);
//
//        $this->assertEquals(200, $response->getStatusCode());
//    }
//
//    public function testUnvalidParamCardNumber()
//    {
//        static::markTestIncomplete('Недоделанный тест');
//        $params = MakePaymentValidatorTestCase::VALID_PARAMS;
//        $params['card_number'] = '-';
//
//        $this->mock(MoneyServiceAFacade::class, function (MockInterface $mock) {
//            $mock->shouldReceive('pay')
////                ->zero()
//            ;
//        });
//
//        $this->mock(IOrderRepository::class, function (MockInterface $mock) {
//            $mock->shouldReceive('setOrderIsPaid')
////                ->zero()
//            ;
//        });
//
//        $response = $this->http->request('POST', 'make-payment', ['json' => $params]);
//
//        $this->assertEquals(400, $response->getStatusCode());
//        $this->assertSee('card_number is invalid');
//    }
//
//    public function testUnavailableMoneyServiceA()
//    {
//        static::markTestIncomplete('Недоделанный тест');
//        $params = MakePaymentValidatorTestCase::VALID_PARAMS;
//
//        $moneyStatusMessageDto = new StatusMessageDto();
//        $moneyStatusMessageDto->setStatus(403);
//        $moneyStatusMessageDto->setMessage('Не получилось списать деньги!!!');
//        $this->mock(MoneyServiceAFacade::class, function (MockInterface $mock) use ($moneyStatusMessageDto) {
//            $mock->shouldReceive('pay')
////                ->once()
//                ->andReturn($moneyStatusMessageDto);
//        });
//
//        $this->mock(IOrderRepository::class, function (MockInterface $mock) {
//            $mock->shouldReceive('setOrderIsPaid')
////                ->zero()
//            ;
//        });
//
//        $response = $this->http->request('POST', 'make-payment', ['json' => $params]);
//
//        $this->assertEquals(403, $response->getStatusCode());
//        $this->assertSee('Не получилось списать деньги!!!');
//    }
//
//    public function testProblemRepository()
//    {
//        static::markTestIncomplete('Недоделанный тест');
//        $params = MakePaymentValidatorTestCase::VALID_PARAMS;
//
//        $moneyStatusMessageDto = new StatusMessageDto();
//        $moneyStatusMessageDto->setStatus(200);
//        $this->mock(MoneyServiceAFacade::class, function (MockInterface $mock) use ($moneyStatusMessageDto) {
//            $mock->shouldReceive('pay')
////                ->once()
//                ->andReturn($moneyStatusMessageDto);
//        });
//
//        $this->mock(IOrderRepository::class, function (MockInterface $mock) {
//            $mock->shouldReceive('setOrderIsPaid')
////                ->once()
//                ->andReturn(false);
//        });
//
//        $response = $this->http->request('POST', 'make-payment', ['json' => $params]);
//
//        $this->assertEquals(500, $response->getStatusCode());
//        $this->assertSee('Internal Error');
//    }
}