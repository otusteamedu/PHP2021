<?php

namespace Services;

class EmailValidator
{
    public static function checkEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && self::checkDomain($email);
    }


    public static function checkEmails(array $emails): array
    {
        $validEmails = [];
        foreach ($emails as $email) {
            $email=trim($email);
            if (self::checkEmail($email)) {
                $validEmails[] = $email;
            }
        }
        return $validEmails;
    }

    private static function checkDomain(string $email): bool
    {
        $domain = explode('@', $email)[1];
        return checkdnsrr($domain, "MX");
    }

}