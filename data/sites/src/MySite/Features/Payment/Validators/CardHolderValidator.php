<?php

declare(strict_types=1);

namespace MySite\Features\Payment\Validators;

use MySite\Features\Payment\Dto\CardData;

/**
 * Class CardHolderValidator
 */
class CardHolderValidator extends AbstractValidator
{

    /**
     * @param CardData $cardData
     * @return CardData
     */
    public function validate(CardData $cardData): CardData
    {
        $result = (bool)preg_match('/^[a-zA-Z_\s]*$/', $cardData->getCardHolder());

        if (!$result) {
            $cardData->setMessage('Wrong Card Holder Name');
        }

        $cardData->setIsValid($result);

        return parent::validate($cardData);
    }

}
