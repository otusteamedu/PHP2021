<?php

namespace AppIntegrationTests;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Repetitor202\controllers\PaymentController;
use Repetitor202\dto\StatusMessageDto;
use Repetitor202\facades\MoneyServiceAFacade;


// по идее чтоб такую штуку пытаться делать, надо сразу сделать соответствующий риквест-класс Req
class Req implements ServerRequestInterface
{}

class RepositoryBackTestCase extends TestCase
{
    public function testSuccess()
    {
        // вставляем в бд ордер

        $controller = new PaymentController();
        $validParams = [
            'order_number' => 123,
            ...
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
        // чистим бд

        $controller = new PaymentController();
        $validParams = [
            'order_number' => 123,
            ...
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