<?php

declare(strict_types=1);

namespace MySite\Features\Payment\Validators;

use MySite\Features\Payment\Dto\CardData;

/**
 * Class OrderSumValidator
 * @package MySite\Features\Payment\Validators
 */
class OrderSumValidator extends AbstractValidator
{

    /**
     * @param CardData $cardData
     * @return CardData
     */
    public function validate(CardData $cardData): CardData
    {
        $result = $cardData->getSum() > 0;

        if (!$result) {
            $cardData->setMessage('Wrong Order Sum');
        }

        $cardData->setIsValid($result);

        return parent::validate($cardData);
    }
}
