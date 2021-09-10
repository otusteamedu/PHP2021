<?php

namespace AppIntegrationTests;

use PHPUnit\Framework\TestCase;

class MoneyServiceABackTestCase extends TestCase
{
    public function testSuccess()
    {
        $validator = new MakePaymentValidator();
        $result = $validator->validate(self::VALID_PARAMS);

        static::assertTrue($result->getIsValid());
    }
}