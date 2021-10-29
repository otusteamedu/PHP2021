<?php


namespace Unit;


use MySite\Features\Payment\Dto\CardData;
use MySite\Features\Payment\Validators\CardNumberValidator;
use PHPUnit\Framework\TestCase;

/**
 * ./vendor/bin/phpunit --testdox ./Tests/Unit/CardHolderValidatorTestCase.php
 *
 * Class ValidatorTestCase
 * @package Unit
 */
class CardHolderValidatorTestCase extends TestCase
{
    /**
     * @var CardNumberValidator
     */
    private CardNumberValidator $validator;

    /**
     * @var CardData
     */
    private CardData $cardData;

    public function setUp(): void
    {
        $this->validator = new CardNumberValidator();
        $this->cardData = new CardData();
    }

    public function testCardNumber()
    {
        $expect = $this->dataProvider();
        $real = [];

        foreach ($expect as $key => $value) {
            $this->cardData->setCardNumber($key);
            $this->validator->validate($this->cardData);
            $real[$key] = $this->cardData->isValid();
        }

        static::assertSame($expect, $real);

    }

    private function dataProvider()
    {
        return [
            1234567891234568 => true,
            '1234567891234567' => true,
            123456789123456 => false,
            '1234567891234566' => true,
            1000000000000000 => true,
            10000000000000000 => false,
        ];
    }
}
