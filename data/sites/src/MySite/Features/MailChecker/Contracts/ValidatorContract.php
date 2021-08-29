<?php


namespace MySite\Features\MailChecker\Contracts;


use MySite\Features\MailChecker\Dto\EmailValidate;

/**
 * Interface ValidatorContract
 * @package MySite\Features\MailChecker\Contracts
 */
interface ValidatorContract
{

    /**
     * @param EmailValidate $emailValidate
     * @return EmailValidate
     */
    public function validate(EmailValidate $emailValidate): EmailValidate;
}
