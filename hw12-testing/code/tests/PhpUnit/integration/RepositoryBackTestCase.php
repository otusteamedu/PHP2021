<?php

namespace PhpUnit\integration;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Repetitor202\controllers\PaymentController;
use Repetitor202\dto\StatusMessageDto;
use Repetitor202\facades\MoneyServiceAFacade;


// по идее чтоб такую штуку пытаться делать, надо сразу сделать соответствующий риквест-класс Req
// я так понимаю, такие тесты не выгодны в разработке (отнимают много времени) ???
class Req // implements ServerRequestInterface
{}

class RepositoryBackTestCase extends TestCase
{
    public function testSuccess()
    {
        static::markTestIncomplete('Недоделанный тест');
        // вставляем в бд ордер

        $controller = new PaymentController();
        $validParams = [
            'order_number' => 123,
//            ...
        ];
        $controller->makePayment(new Req($validParams));

        $moneyStatusMessageDto = new StatusMessageDto();
        $moneyStatusMessageDto->setStatus(200);
        $this->mock(MoneyServiceAFacade::class, function (MockInterface $mock) use ($moneyStatusMessageDto) {
            $mock->shouldReceive('pay')
                ->once()
                ->andReturn($moneyStatusMessageDto);
        });

        $this->assertSeeInDatabase($validParams);
    }

    public function testOrderIsAbsent()
    {
        static::markTestIncomplete('Недоделанный тест');
        // чистим бд

        $controller = new PaymentController();
        $validParams = [
            'order_number' => 123,
//            ...
        ];
        $controller->makePayment(new Req($validParams));

        $moneyStatusMessageDto = new StatusMessageDto();
        $moneyStatusMessageDto->setStatus(200);
        $this->mock(MoneyServiceAFacade::class, function (MockInterface $mock) use ($moneyStatusMessageDto) {
            $mock->shouldReceive('pay')
                ->once()
                ->andReturn($moneyStatusMessageDto);
        });

        // ловим ошибку о том, что такого ордера не существует
    }
}