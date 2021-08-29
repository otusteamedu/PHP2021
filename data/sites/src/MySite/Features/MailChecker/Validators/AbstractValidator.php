<?php

declare(strict_types=1);

namespace MySite\Features\MailChecker\Validators;


use MySite\Features\MailChecker\Contracts\ValidatorContract;
use MySite\Features\MailChecker\Dto\EmailValidate;

/**
 * Class AbstractValidator
 * @package MySite\Features\MailChecker\Validators
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
            DomainValidator::class => new DomainValidator(),
            default => null
        };

        return $this->nextValidator;
    }


    public function validate(EmailValidate $emailValidate): EmailValidate
    {
        if ($emailValidate->isValid() && $this->nextValidator) {
            $this->nextValidator->validate($emailValidate);
        }
        return $emailValidate;
    }
}
