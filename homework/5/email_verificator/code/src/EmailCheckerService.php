<?php

namespace App;

class EmailCheckerService
{
    public static function checkEmailByRegExpression(string $emailAddress): bool
    {
        preg_match('/(\S+)@([a-z0-9.]+)/is', $emailAddress, $matchList);

        return isset($matchList[0]);
    }

    public static function checkEmailByMX(string $emailAddress): bool
    {
        $p = stripos($emailAddress, '@');

        if ($p === false) {
            return false;
        }

        $host = substr($emailAddress, $p + 1);

        getmxrr($host, $r);

        return isset($r[0]);
    }

    public static function checkEmail(string $emailAddress): bool
    {
        return (   self::checkEmailByRegExpression($emailAddress)
                && self::checkEmailByMX($emailAddress)
        );
    }

    /**
     * @param string[] $emailAddressList
     * @return true|string
     */
    public static function checkEmailList(array $emailAddressList)
    {
        foreach ($emailAddressList as $emailAddress) {
            if (! self::checkEmail($emailAddress)) {
                return $emailAddress;
            }
        }

        return true;
    }
}
