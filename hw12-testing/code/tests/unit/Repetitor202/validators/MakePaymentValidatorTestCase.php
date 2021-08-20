<?php

namespace AppUnitTests\Repetitor202\validators;

use PHPUnit\Framework\TestCase;
use Repetitor202\validators\payment\MakePaymentValidator;

class MakePaymentValidatorTestCase extends TestCase
{
    private const VALID_PARAMS = [
        'card_holder' => 'Ivan Ivanov',
        'card_number' => 1234567890123456,
        'card_expiration' => '12/22',
        'cvv' => 123,
        'order_number' => 'order-123',
        'sum' => 123.40
    ];

    public function testSuccess()
    {
        $validator = new MakePaymentValidator();
        $result = $validator->validate(self::VALID_PARAMS);

        static::assertSame(true, $result->getIsValid());
    }
    
    public function testNullParams()
    {
        $validator = new MakePaymentValidator();
        $result = $validator->validate(null);

        static::assertSame(
            [
                false,
                'Input params are invalid',
            ],
            [
                $result->getIsValid(),
                $result->getMessage(),
            ]
        );
    }

    public function testCardHolderIsAbsent()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        unset($params['card_holder']);
        $result = $validator->validate($params);

        static::assertSame(false, $result->getIsValid());
    }

    public function testCardHolderIsAbsentMessage()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        unset($params['card_holder']);
        $result = $validator->validate($params);

        static::assertSame('card_holder is absent', $result->getMessage());
    }

    public function testCardHolderIsUnvalid()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_holder'] = 'I@ Ivanov';
        $result = $validator->validate($params);

        static::assertSame(false, $result->getIsValid());
    }

    public function testCardHolderRuIsUnvalid()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_holder'] = 'Иван Иванов';
        $result = $validator->validate($params);

        static::assertSame(false, $result->getIsValid());
    }

    public function testCardNumberIsAbsent()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        unset($params['card_number']);
        $result = $validator->validate($params);

        static::assertSame(false, $result->getIsValid());
    }

    public function testCardNumber15Digits()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_number'] = 123456789012345;
        $result = $validator->validate($params);

        static::assertSame(false, $result->getIsValid());
    }
}