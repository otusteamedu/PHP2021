<?php

namespace AppSystemTests;

use AppUnitTests\Repetitor202\validators\MakePaymentValidatorTestCase;
use GuzzleHttp\Client as GuzzleHttpClient;
use PHPUnit\Framework\TestCase;
use Repetitor202\dto\StatusMessageDto;
use Repetitor202\facades\MoneyServiceAFacade;
use Repetitor202\repositories\IOrderRepository;

class SystemTestCase extends TestCase
{
    private ?GuzzleHttpClient $http;

    public const VALID_PARAMS = [
        'card_holder' => 'Ivan Ivanov-Petrov',
        'card_number' => '1234567890123456',
        'card_expiration' => '12/22',
        'cvv' => '123',
        'order_number' => 'order-123',
        'sum' => '123.40'
    ];

    public function setUp(): void
    {
        $this->http = new GuzzleHttpClient(['base_uri' => 'http://unittests.hw/']);
    }

    public function tearDown(): void {
        $this->http = null;
    }

    // этот тест надо только в супер нужных случаях запускать
    // по идее этот тест должен быть заккомментирован или лежать в редко запускаемом файле
    public function testSuccess()
    {
        $response = $this->http->request('POST', 'make-payment', ['json' => self::VALID_PARAMS]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    // этот тест тоже надо только в супер нужных случаях запускать
    // по идее этот тест должен быть заккомментирован или лежать в редко запускаемом файле
    // order_number отсутствует в базе, чисто чтоб валидацию проходил
    public function testUnexistedOrder()
    {
        $params = self::VALID_PARAMS;
        $params['order_number'] = 'unreal';
        $response = $this->http->request('POST', 'make-payment', ['json' => $params]);

        $this->assertEquals(500, $response->getStatusCode());
    }

    // параметры должны пройти валидацию, но в реале такой карты нет
    public function testUnrealСardData()
    {
        $params = self::VALID_PARAMS;
        $params['card_number'] = '1111111111111111';

        $response = $this->http->request('POST', 'make-payment', ['json' => $params]);

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertSee('что-то не то с данными карты');
    }
}