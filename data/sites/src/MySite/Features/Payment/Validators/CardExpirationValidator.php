<?php
declare(strict_types=1);

namespace MySite\Features\Payment\Validators;


use MySite\Features\Payment\Dto\CardData;

class CardExpirationValidator extends AbstractValidator
{

    /**
     * @param CardData $cardData
     * @return CardData
     */
    public function validate(CardData $cardData): CardData
    {
        $matches = [];
        $result = (
            preg_match('/^([0-9]{2})\/([0-9]{2})$/', $cardData->getCardExpiration(), $matches) &&
            2000 + $matches[2] >= date("Y") &&
            ($matches[1] >= 0 && $matches[1] <= 12)
        );

        if (!$result) {
            $cardData->setMessage('Wrong Expiration Date');
        }

        $cardData->setIsValid($result);

        return parent::validate($cardData);
    }
}
