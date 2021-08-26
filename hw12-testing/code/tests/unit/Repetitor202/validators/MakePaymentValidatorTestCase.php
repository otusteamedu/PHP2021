<?php

namespace AppUnitTests\Repetitor202\validators;

use PHPUnit\Framework\TestCase;
use Repetitor202\validators\payment\MakePaymentValidator;

class MakePaymentValidatorTestCase extends TestCase
{
    private const VALID_PARAMS = [
        'card_holder' => 'Ivan Ivanov-Petrov',
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

        static::assertTrue($result->getIsValid());
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

        static::assertFalse($result->getIsValid());
    }

    public function testCardHolderIsAbsentMessage()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        unset($params['card_holder']);
        $result = $validator->validate($params);

        static::assertSame('card_holder is absent', $result->getMessage());
    }

    public function testCardHolderForbiddenSymbol()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_holder'] = 'I@ Ivanov';
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    public function testCardHolderRu()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_holder'] = 'Иван Иванов';
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    public function testCardHolderTwoSpaces()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_holder'] = 'Ivan  Ivanov';
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    public function testCardNumberIsAbsent()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        unset($params['card_number']);
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    public function testCardNumber15Digits()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_number'] = 123456789012345;
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    public function testCardNumber17Digits()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_number'] = 12345678901234567;
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    public function testCardNumberIsString()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_number'] = 's1s2s3s4s5s6s7s8';
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    public function testCardExpirationUnrealDate()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_expiration'] = '13/25';
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    public function testCardExpirationStringDate()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_expiration'] = '05.22';
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    public function testCardExpirationBackslash()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_expiration'] = '05\22';
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    public function testCardExpirationNotFiveSymbols()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_expiration'] = '5/22';
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    public function testCardExpirationDateIsLessThanNow()
    {
        $validator = new MakePaymentValidator();
        $params = self::VALID_PARAMS;
        $params['card_expiration'] = '11/20';
        $result = $validator->validate($params);

        static::assertFalse($result->getIsValid());
    }

    /* Если длина поля cvv не равно 3 => static::assertFalse($result->getIsValid()); */
    public function testCvvLengthNot3()
    {
        static::markTestIncomplete('Недоделанный тест');

        static::assertFalse($result->getIsValid());
    }

    /* Если поле cvv не целое число => static::assertFalse($result->getIsValid()); */
    public function testCvvLengthNotInteger()
    {
        static::markTestIncomplete('Недоделанный тест');

        static::assertFalse($result->getIsValid());
    }

    /* Если поле cvv меньше 0 => static::assertFalse($result->getIsValid()); */

    /* Если длина поля order_number больше 16 => static::assertFalse($result->getIsValid()); */
    /* Если поле order_number содержит хоть один спецсимвол(разрешены цифры и буквы английского алфавита в разных регистрах) => static::assertFalse($result->getIsValid()); */

    /* Если поле sum не является строкой => static::assertFalse($result->getIsValid()); */
    /* Если поле sum не содержит запятую => static::assertFalse($result->getIsValid()); */
    /* Если в поле sum после запятой не число => static::assertFalse($result->getIsValid()); */
    /* Если в поле sum перед запятой не число => static::assertFalse($result->getIsValid()); */
    /* Если в поле sum стоит первый символ “-” => static::assertFalse($result->getIsValid()); */
}