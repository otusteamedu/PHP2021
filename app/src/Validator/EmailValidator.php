<?php

namespace Src\Validator;

class EmailValidator
{
    public function isValid(string $email): bool
    {
        if (empty($email)) {
            return false;
        }

        if (!$this->checkFormat($email)) {
            return false;
        }

        if (!$this->checkMX($email)) {
            return false;
        }

        return true;
    }

    private function checkFormat(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function checkMX(string $email): bool
    {
        $host = substr($email, strpos($email, '@') + 1);
        return checkdnsrr($host, 'MX');
    }
}
