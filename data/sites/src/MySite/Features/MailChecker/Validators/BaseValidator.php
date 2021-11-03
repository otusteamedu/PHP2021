<?php

declare(strict_types=1);

namespace MySite\Features\MailChecker\Validators;

use MySite\Features\MailChecker\Dto\EmailValidate;

/**
 * Class BaseValidator
 * @package MySite\Features\MailChecker\Validators
 */
class BaseValidator extends AbstractValidator
{

    /**
     * @param EmailValidate $emailValidate
     * @return EmailValidate
     */
    public function validate(EmailValidate $emailValidate): EmailValidate
    {
        $result = (
            $emailValidate->getName() &&
            filter_var($emailValidate->getEmail(), FILTER_VALIDATE_EMAIL)
        );

        if (!$result) {
            $emailValidate->setIsValid(false);
            $emailValidate->setComment('Неправильный email');
        }

        return parent::validate($emailValidate);
    }
}
