<?php

declare(strict_types=1);

namespace MySite\Features\Payment\Validators;


use MySite\Features\Payment\Dto\CardData;

/**
 * Class BaseValidator
 * @package MySite\Features\Payment\Validators
 */
class BaseValidator extends AbstractValidator
{

    /**
     * @param CardData $cardData
     * @return CardData
     */
    public function validate(CardData $cardData): CardData
    {
        $result = (
            $cardData->getCardNumber() &&
            $cardData->getCardHolder() &&
            $cardData->getCardExpiration() &&
            $cardData->getCvv() > 0 &&
            $cardData->getOrderNumber() &&
            $cardData->getSum()
        );

        $cardData->setIsValid($result);

        return parent::validate($cardData);
    }
}
