<?php

namespace App\Utils;

class FormValidator
{

    public static function isValid(array $form): bool
    {
        if (!self::isValidDate($form['date_from'])
            || !self::isValidDate($form['date_to'])
            || !self::isValidMail($form['email'])
        ) {
            return false;
        }

        return true;
    }

    private static function isValidDate(string $date): bool
    {
        if (strtotime($date) === false) {
            return false;
        }

        return true;
    }

    private static function isValidMail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }

        return true;
    }
}
