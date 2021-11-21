<?php

namespace App\EmailVerification;

class Verification
{

    public static function run(string $email) : void
    {
        try {
            self::checkSyntax($email);
            self::checkDNSMx($email);

            echo $email . ': OK' . '<br>';
        } catch (\Exception $e) {
            echo $email . ': ' . $e->getMessage() . '<br>';
        }
    }

    /**
     * @param $email
     * @throws \Exception
     */
    private static function checkSyntax($email) : void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email syntax incorrect');
        }
    }

    /**
     * @param $email
     * @throws \Exception
     */
    private static function checkDNSMx($email) : void
    {
        $domain = explode('@', $email)[1];
        if (!getmxrr($domain, $mxhosts, $weights)) {
            throw new \Exception('Do not found MX records');
        }
    }
}
