<?php
declare(strict_types=1);

namespace MySite\Features\Payment\Validators;


use MySite\Features\Payment\Dto\CardData;

/**
 * Class CardNumberValidator
 * @package MySite\Features\Payment\Validators
 */
class CardNumberValidator extends AbstractValidator
{

    /**
     * @param CardData $cardData
     * @return CardData
     */
    public function validate(CardData $cardData): CardData
    {
        $result = (
            $cardData->getCardNumber() >= 1000000000000000 &&
            $cardData->getCardNumber() < 10000000000000000
        );

        if (!$result) {
            $cardData->setMessage('Wrong Card Number');
        }

        $cardData->setIsValid($result);

        return parent::validate($cardData);
    }
}
