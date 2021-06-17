<?php


namespace Repetitor202\Email;


class HostnameValidator
{
    public static function validate(string $email): bool
    {
        $emailPieces = explode('@', $email);
        $hostname = $emailPieces[1];

        $hosts = [];

        return getmxrr($hostname, $hosts);
    }
}