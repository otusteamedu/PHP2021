<?php

namespace Unit;


use MySite\Features\Payment\Dto\CardData;
use MySite\Features\Payment\Validators\CardExpirationValidator;
use MySite\Features\Payment\Validators\CardNumberValidator;
use PHPUnit\Framework\TestCase;

/**
 * ./vendor/bin/phpunit --testdox ./Tests/Unit/CardHolderValidatorTestCase.php
 *
 * Class CardExpirationValidatorTestCase
 * @package Unit
 */
class CardExpirationValidatorTestCase extends TestCase
{
    /**
     * @var CardExpirationValidator
     */
    private CardExpirationValidator $validator;

    /**
     * @var CardData
     */
    private CardData $cardData;

    public function setUp(): void
    {
        $this->validator = new CardExpirationValidator();
        $this->cardData = new CardData();
    }

    public function testCardDates()
    {
        $expect = $this->dataProvider();
        $real = [];

        foreach ($expect as $key => $value) {
            $this->cardData->setCardExpiration($key);
            $this->validator->validate($this->cardData);
            $real[$key] = $this->cardData->isValid();
        }

        static::assertSame($expect, $real);
    }

    private function dataProvider()
    {
        return [
            '12/20' => false,
            '12/21' => true,
            '01/22' => true,
            '00/22' => false,
            '13/22' => false,
        ];
    }
}
