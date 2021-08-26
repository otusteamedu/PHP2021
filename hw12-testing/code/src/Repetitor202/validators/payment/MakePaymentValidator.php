<?php

namespace Repetitor202\validators\payment;

use Repetitor202\dto\ValidatorResultDto;

class MakePaymentValidator implements IMakePaymentValidator
{
    private ValidatorResultDto $validatorResultDto;

    public function __construct()
    {
        $this->validatorResultDto = new ValidatorResultDto();
    }

    public function validate(?array $params): ValidatorResultDto
    {
        if (! is_array($params)) {
            $this->validatorResultDto->setIsValid(false);
            $this->validatorResultDto->setMessage('Input params are invalid');

            return $this->validatorResultDto;
        }

        $validatorParamsKeys = $this->validateParamsKeys($params);
        if (! $validatorParamsKeys->getIsValid()) {
            return $validatorParamsKeys;
        }

        $validatorCardHolder = $this->validateCardHolder($params['card_holder']);
        if (! $validatorCardHolder->getIsValid()) {
            return $validatorCardHolder;
        }

        $validatorCardNumber = $this->validateCardNumber($params['card_number']);
        if (! $validatorCardNumber->getIsValid()) {
            return $validatorCardNumber;
        }

        $validatorCardExpiration = $this->validateCardExpiration($params['card_expiration']);
        if (! $validatorCardExpiration->getIsValid()) {
            return $validatorCardExpiration;
        }

        return $this->validatorResultDto;
    }

    private function validateParamsKeys(array $params): ValidatorResultDto
    {
        $requiredFields = [
            'card_holder',
            'card_number',
            'card_expiration',
//            'cvv',
//            'order_number',
//            'sum',
        ];

        foreach ($requiredFields as $requiredField) {
            if (! array_key_exists($requiredField, $params)) {
                $this->validatorResultDto->setIsValid(false);
                $this->validatorResultDto->setMessage($requiredField . ' is absent');

                return $this->validatorResultDto;
            }
        }

        return $this->validatorResultDto;
    }

    private function validateCardHolder(string $fullName): ValidatorResultDto
    {
        if (! preg_match('/\b[a-z]+ [a-z]+\-?[a-z]+\b/i', $fullName)) {
            $this->validatorResultDto->setIsValid(false);
            $this->validatorResultDto->setMessage('card_holder is invalid');
        }

        return $this->validatorResultDto;
    }

    private function validateCardNumber(string $cardNumber): ValidatorResultDto
    {
        if (! preg_match('/\b[0-9]{16}\b/', $cardNumber)) {
            $this->validatorResultDto->setIsValid(false);
            $this->validatorResultDto->setMessage('card_number is invalid');
        }

        return $this->validatorResultDto;
    }

    // todo: cardExpiration must be >= now
    private function validateCardExpiration(string $cardExpiration): ValidatorResultDto
    {
        if (! preg_match('/\b(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})\b/', $cardExpiration)) {
            $this->validatorResultDto->setIsValid(false);
            $this->validatorResultDto->setMessage('card_expiration is invalid');
        }

        return $this->validatorResultDto;
    }
}