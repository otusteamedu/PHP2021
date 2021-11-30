<?php


namespace System;


use GuzzleHttp\Client;
use MySite\Http\HttpCodes;
use PHPUnit\Framework\TestCase;

/**
 *
 * ./vendor/bin/phpunit --testdox ./Tests/System/PaymentTestCase.php
 *
 * Class PaymentTestCase
 * @package System
 */
class PaymentTestCase extends TestCase
{

    /**
     * @var Client
     */
    private Client $httpClient;

    public function setUp(): void
    {
        $this->httpClient = new Client(
            [
                'verify' => false
            ]
        );
    }

    public function testGoodCard()
    {
        $real = [
            'success' => false,
            'message' => null,
        ];
        $request = $this
            ->httpClient
            ->post(
                'nginx',
                [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
                    ],
                    'body' => json_encode($this->getGoodCardData())
                ]
            );
        $real['success'] = $request->getStatusCode() === HttpCodes::OK;


        if ($real['success']) {
            $json = json_decode($request->getBody()->getContents());
            $result['message'] = $json->message;
        }
        self::assertSame(
            [
                'success' => true,
                'message' => 'Payment is complete',
            ],
            $real
        );
    }

    private function getGoodCardData()
    {
        return [
            "card_number" => 1234567891234567,
            "card_holder" => "Test",
            "card_expiration" => "12/25",
            "cvv" => 999,
            "order_number" => "1234567891234567",
            "sum" => "12,35"
        ];
    }

    public function testBadCard()
    {
        $real = [
            'success' => false,
            'message' => null,
        ];
        $request = $this
            ->httpClient
            ->post(
                'nginx',
                [
                    'body' => json_encode($this->getBadCardData())
                ]
            );
        $real['success'] = $request->getStatusCode() === HttpCodes::BAD_REQUEST;


        if ($real['success']) {
            $json = json_decode($request->getBody()->getContents());
            $result['message'] = $json->message;
        }
        self::assertSame(
            [
                'success' => true,
                'message' => 'Wrong Cvv',
            ],
            $real
        );
    }

    private function getBadCardData()
    {
        return [
            "card_number" => 1234567891234567,
            "card_holder" => "Test",
            "card_expiration" => "00/00",
            "cvv" => 999,
            "order_number" => "1234567891234567",
            "sum" => "12,35"
        ];
    }
}
