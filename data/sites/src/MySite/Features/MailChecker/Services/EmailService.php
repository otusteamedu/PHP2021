<?php

declare(strict_types=1);

namespace MySite\Features\MailChecker\Services;


use MySite\Features\MailChecker\Dto\EmailValidate;
use MySite\Features\MailChecker\Validators\BaseValidator;
use MySite\Features\MailChecker\Validators\DomainValidator;

/**
 * Class EmailService
 * @package MySite\Features\MailChecker\Services
 */
class EmailService
{

    /**
     * @param EmailValidate $emailValidateDto
     */
    public static function validate(EmailValidate $emailValidateDto)
    {
        $baseValidator = new BaseValidator();

        $baseValidator->add(DomainValidator::class);

        $baseValidator->validate($emailValidateDto);
    }
}
