<?php

declare(strict_types=1);

namespace MySite\Features\Payment\Services;


use MySite\Features\Payment\Dto\CardData;
use MySite\Features\Payment\Validators\BaseValidator;
use MySite\Features\Payment\Validators\CardCvvValidator;
use MySite\Features\Payment\Validators\CardExpirationValidator;
use MySite\Features\Payment\Validators\CardHolderValidator;
use MySite\Features\Payment\Validators\CardNumberValidator;
use MySite\Features\Payment\Validators\OrderNumberValidator;
use MySite\Features\Payment\Validators\OrderSumValidator;
use MySite\Http\HttpCodes;
use Throwable;

/**
 * Class PaymentService
 * @package MySite\Features\Payment\Services
 */
class PaymentService
{


    public function validate(CardData $cardData)
    {
        $baseValidator = new BaseValidator();

        $baseValidator
            ->add(CardNumberValidator::class)
            ->add(CardHolderValidator::class)
            ->add(CardExpirationValidator::class)
            ->add(CardCvvValidator::class)
            ->add(OrderNumberValidator::class)
            ->add(OrderSumValidator::class);

        $baseValidator->validate($cardData);
    }

    /**
     * @param CardData $cardDto
     * @return bool
     */
    public function pushPayment(CardData $cardDto): bool
    {
        return true;
    }

    /**
     * @param CardData $cardDto
     * @return bool
     * @throws Throwable
     */
    public function savePayment(CardData $cardDto): bool
    {
        return true;
    }
}
