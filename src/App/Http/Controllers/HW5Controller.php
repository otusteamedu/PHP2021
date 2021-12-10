<?php

namespace Yu2ry\App\Http\Controllers;

use Yu2ry\Support\Validations\Rules\RuleData;
use Yu2ry\Support\Validations\Rules\RuleEmail;
use Yu2ry\Support\Validations\Rules\RuleEmails;
use Yu2ry\Support\Validations\Validator;

/**
 * Class HW5Controller
 * @package Yu2ry\App\Http\Controllers
 */
class HW5Controller
{

    private const REQUEST_EMAIL = 'email';
    private const REQUEST_EMAILS = 'emails';

    /**
     * @return void
     */
    public function checkEmail(): void
    {
        $validator = new Validator();

        $validator->addRule(
            RuleEmail::factory(
                new RuleData($_GET[self::REQUEST_EMAIL] ?? '')
            )
        );

        if (!$validator->passes()) {
            echo $validator->getErrorMessageText();
            return;
        }

        echo 'ok';
    }

    /**
     * @return void
     */
    public function checkEmails(): void
    {
        $validator = new Validator();

        $validator->addRule(
            RuleEmails::factory(
                new RuleData($_GET[self::REQUEST_EMAILS] ?? [])
            )
        );

        if (!$validator->passes()) {
            echo $validator->getErrorMessageText();
            return;
        }

        echo 'ok';
    }

    /**
     * @return Validator
     */
    protected function makeValidator(): Validator
    {
        return new Validator();
    }
}