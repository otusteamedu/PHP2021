<?php
declare(strict_types=1);

namespace MySite\Features\Payment\Validators;

use MySite\Features\Payment\Dto\CardData;

/**
 * Class OrderValidator
 * @package MySite\Features\Payment\Validators
 */
class OrderNumberValidator extends AbstractValidator
{

    /**
     * @param CardData $cardData
     * @return CardData
     */
    public function validate(CardData $cardData): CardData
    {
        $result = strlen($cardData->getOrderNumber()) == 16;

        if (!$result) {
            $cardData->setMessage('Wrong Order Number');
        }

        $cardData->setIsValid($result);

        return parent::validate($cardData);
    }
}
