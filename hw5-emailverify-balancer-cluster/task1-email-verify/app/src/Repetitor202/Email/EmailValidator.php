<?php


namespace Repetitor202\Email;


class EmailValidator implements IValidator
{
    public function validate(string $email): bool
    {
        $templateEmail = '/^[a-z0-9-.+_]+@[a-z0-9-.+_]+.[a-z]{2,4}$/i';

        return preg_match($templateEmail, $email);
    }

    public function doReport(string $email): string
    {
        $report = 'email: ';
        $report .= $this->validate($email) ? 'valid' : 'invalid';

        return $report;
    }
}