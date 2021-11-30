<?php

declare(strict_types=1);

namespace MySite\Features\Payment\Validators;


use MySite\Features\Payment\Dto\CardData;

/**
 * Class CardCvvValidator
 * @package MySite\Features\Payment\Validators
 */
class CardCvvValidator extends AbstractValidator
{

    /**
     * @param CardData $cardData
     * @return CardData
     */
    public function validate(CardData $cardData): CardData
    {
        $result = (
            $cardData->getCvv() >= 100 &&
            $cardData->getCvv() < 1000
        );

        if (!$result) {
            $cardData->setMessage('Wrong Cvv');
        }

        $cardData->setIsValid($result);


        return parent::validate($cardData);
    }
}
