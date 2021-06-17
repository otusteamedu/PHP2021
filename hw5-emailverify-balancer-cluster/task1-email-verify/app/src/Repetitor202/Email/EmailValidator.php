<?php


namespace Repetitor202\Email;


class EmailValidator
{
    public static function validate(string $email): bool
    {
        $templateEmail = '/^[a-z0-9-.+_]+@[a-z0-9-.+_]+.[a-z]{2,4}$/i';

        return preg_match($templateEmail, $email);
    }
}