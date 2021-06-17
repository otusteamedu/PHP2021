<?php


namespace Repetitor202\Email;


class Report
{
    /**
     * @param array $emails
     */
    public final function validateList(array $emails): void
    {
        foreach ($emails as $email) {
            $emailReport = $email;

            $emailReport .= ' email:';
            $emailReport .= EmailValidator::validate($email) ? 'valid' : 'invalid';

            $emailReport .= ' host:';
            $emailReport .= HostnameValidator::validate($email) ? 'valid' : 'invalid';

            echo $emailReport . PHP_EOL;
        }
    }
}