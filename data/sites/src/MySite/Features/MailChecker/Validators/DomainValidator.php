<?php

declare(strict_types=1);

namespace MySite\Features\MailChecker\Validators;

use MySite\Features\MailChecker\Dto\EmailValidate;

/**
 * Class DomainValidator
 * @package MySite\Features\MailChecker\Validators
 */
class DomainValidator extends BaseValidator
{

    /**
     * @param EmailValidate $emailValidate
     * @return EmailValidate
     */
    public function validate(EmailValidate $emailValidate): EmailValidate
    {
        $result = (
            $emailValidate->getDomain() &&
            str_contains($emailValidate->getDomain(), '.') &&
            checkdnsrr($emailValidate->getDomain(), 'MX')
        );

        if (!$result) {
            $emailValidate->setIsValid(false);
            $emailValidate->setComment('Неправильный домен');
        }

        return parent::validate($emailValidate);
    }
}
