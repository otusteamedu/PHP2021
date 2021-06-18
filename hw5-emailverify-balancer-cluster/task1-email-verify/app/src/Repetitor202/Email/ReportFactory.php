<?php


namespace Repetitor202\Email;


class ReportFactory implements IEmailReport
{
    private bool $emailValidate;
    private bool $hostnameValidate;

    /**
     * @param array $emails
     */
    public final function validateList(array $emails): void
    {
        foreach ($emails as $email) {
            $emailReport = $email;

            if($this->emailValidate) {
                $emailReport .= ' email:';
                $emailReport .= EmailValidator::validate($email) ? 'valid' : 'invalid';
            }

            if($this->hostnameValidate) {
                $emailReport .= ' host:';
                $emailReport .= HostnameValidator::validate($email) ? 'valid' : 'invalid';
            }

            echo $emailReport . PHP_EOL;
        }
    }

    public function setValidateEmail(bool $trueFalse = true): void
    {
        $this->emailValidate = $trueFalse;
    }

    public function setValidateHostname(bool $trueFalse = true): void
    {
        $this->hostnameValidate = $trueFalse;
    }
}