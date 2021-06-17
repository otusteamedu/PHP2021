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
            $validator = new Validator();
            $params = $validator->validateParams($email);

            $emailReport = $email;

            $emailReport .= ' email:';
            $emailReport .= $params->getEmail() ? 'valid' : 'invalid';

            $emailReport .= ' host:';
            $emailReport .= $params->getHostname() ? 'valid' : 'invalid';

            echo $emailReport . PHP_EOL;
        }
    }
}