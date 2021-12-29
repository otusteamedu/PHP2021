<?php

namespace Services;

class EmailValidator
{
    private array $emailList;
    private array $validEmails;

    function __construct($emailList)
    {
        if (is_array($emailList)) {
            $this->emailList = $emailList;
        } else {
            $this->emailList[] = $emailList;
        }
    }


    private function checkEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) && self::checkEmailDomain($email);
    }


    private function checkEmails()
    {
        $validEmails = [];
        foreach ($this->emailList as $email) {
            $email = trim($email);
            if (self::checkEmail($email)) {
                $validEmails[] = $email;
            }
        }
        $this->validEmails = $validEmails;
    }

    private function checkEmailDomain(string $email): bool
    {
        $domain = explode('@', $email)[1];
        return checkdnsrr($domain, "MX");
    }

    /**
     * @return array
     */
    public function getValidEmails(): array
    {
        $this->checkEmails();
        return $this->validEmails;
    }

    public function printValidEmails()
    {
        $this->checkEmails();
        if (count($this->validEmails) > 0) {
            echo "Correct emails:\n";
            foreach ($this->validEmails as $email) {
                echo $email . "\n";
            }
        } else {
            echo "All Emails not correct!\n";
        }
    }

}