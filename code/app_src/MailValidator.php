<?php

namespace App;

class MailValidator
{
    private $emailValidRegExp = '/^(([\wА-Яа-я]{1,})@([\wА-Яа-я]{1,}\.)+[A-Za-zА-Яа-я]{2,})$/ui';
    private $emailAddress;

    public function validateEmails(array $arEmails)
    {
        $arResult = [];

        foreach ($arEmails as $email) {
            $arResult[] = [
                'EMAIL' => $email,
                'RESULT' => $this->validate($email)
            ];
        }

        if ($arResult == '') {
            throw new \Exception('DATA_NO_GENERATED');
        }
        Response::generateOkResponse($arResult);
    }

    public function validate(string $email): string
    {
        if ($email == '') {
            return 'EMPTY_INPUT';
        }

        $this->emailAddress = $email;

        if ($this->validateEmailAddress()) {

            if ($this->checkMXRecord()) {
                return 'EMAIL_OK';
            } else {
                return 'EMAIL_MX_FAILED';
            }
        }

        return 'EMAIL_VALID_FAILED';
    }

    private function validateEmailAddress()
    {
        return preg_match($this->emailValidRegExp, $this->emailAddress);
    }

    private function checkMXRecord(): bool 
    {
        $arMailAddress = explode('@', $this->emailAddress);

        return getmxrr($arMailAddress[1], $hosts);
    }
}
