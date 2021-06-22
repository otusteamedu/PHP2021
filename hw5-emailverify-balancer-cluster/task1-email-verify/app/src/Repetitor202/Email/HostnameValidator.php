<?php


namespace Repetitor202\Email;


class HostnameValidator implements IValidator
{
    public function validate(string $email): bool
    {
        $emailPieces = explode('@', $email);
        $hostname = $emailPieces[1];

        $hosts = [];

        return getmxrr($hostname, $hosts);
    }

    public function doReport(string $email): string
    {
        $report = 'hostname: ';
        $report .= $this->validate($email) ? 'valid' : 'invalid';

        return $report;
    }
}