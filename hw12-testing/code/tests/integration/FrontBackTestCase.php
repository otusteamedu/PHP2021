<?php

namespace AppIntegrationTests;

use AppUnitTests\Repetitor202\validators\MakePaymentValidatorTestCase;
use GuzzleHttp\Client as GuzzleHttpClient;
use PHPUnit\Framework\TestCase;

class FrontBackTestCase extends TestCase
{
    private ?GuzzleHttpClient $http;

    public function setUp(): void
    {
        $this->http = new GuzzleHttpClient(['base_uri' => 'http://unittests.hw/']);
    }

    public function tearDown(): void {
        $this->http = null;
    }

    public function testSuccess()
    {
        $stub = $this->createMock(IOrderRepository::class);

        // Настроить заглушку.
        $stub->method('setOrderIsPaid')
            ->willReturn(true);
        $response = $this->http->request('POST', 'make-payment', ['json' => MakePaymentValidatorTestCase::VALID_PARAMS]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}