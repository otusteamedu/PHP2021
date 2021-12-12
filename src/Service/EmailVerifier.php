<?php

namespace App\Service;

use Exception;

class EmailVerifier
{
    /**
     * @param string[] $emailList
     *
     * @return bool[]
     * @throws Exception
     */
    public function verify(array $emailList): array
    {
        $result = [];
        foreach ($emailList as $email) {
            $result[$email] = $this->isValid($email);
        }

        return $result;
    }

    private function isValid(string $str): bool
    {
        $email = filter_var($str, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            return false;
        }

        $parsedEmail = explode('@', $email);
        $hostname = array_pop($parsedEmail);
        $hosts = [];

        return getmxrr($hostname, $hosts);
    }
}
