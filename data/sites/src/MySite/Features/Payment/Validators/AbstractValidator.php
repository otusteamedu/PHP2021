<?php

declare(strict_types=1);

namespace MySite\Features\Payment\Validators;


use MySite\Features\Payment\Contracts\ValidatorContract;
use MySite\Features\Payment\Dto\CardData;
use MySite\Features\Payment\Dto\EmailValidate;

/**
 * Class AbstractValidator
 * @package MySite\Features\Payment\Validators
 */
class AbstractValidator implements ValidatorContract
{
    /**
     * @var ValidatorContract|null
     */
    private ?ValidatorContract $nextValidator = null;

    /**
     * @param string $validator
     * @return ValidatorContract
     */
    public function add(string $validator): ValidatorContract
    {
        $this->nextValidator = match ($validator) {
            CardNumberValidator::class => new CardNumberValidator(),
            CardHolderValidator::class => new CardHolderValidator(),
            CardExpirationValidator::class => new CardExpirationValidator(),
            CardCvvValidator::class => new CardCvvValidator(),
            OrderNumberValidator::class => new OrderNumberValidator(),
            OrderSumValidator::class => new OrderSumValidator(),
            default => null
        };

        return $this->nextValidator;
    }


    public function validate(CardData $cardData): CardData
    {
        if ($cardData->isValid() && $this->nextValidator) {
            $this->nextValidator->validate($cardData);
        }
        return $cardData;
    }
}
