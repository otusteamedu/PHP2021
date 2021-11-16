<?php

namespace App;

class MailValidator
{
    private $reg_exp = '/^(([\wА-Яа-я]{1,})@([\wА-Яа-я]{1,}\.)+[A-Za-zА-Яа-я]{2,})$/ui';
    private $mailAddress;

    public function validateEmailList($arEmailList) {
        $result = '';
        foreach ($arEmailList as $mailAddress) {
            try {
                $result .= $this->validate($mailAddress);
            }
            catch(Exception $e) {
                
            }
        }
        if($result == '') {
            throw new \Exception('No data generated');
        }
        Response::generateOkResponse($result);
    }

    public function validate($mailAddress)
    {
        if($mailAddress == '') {
            return;
        }
        $this->mailAddress = $mailAddress;
        if($this->validateMailAddress()) {
            if ($this->checkMXRecord()) {
                return "$mailAddress is valid and MX record found </br>".PHP_EOL;
            }
        }
        return "$mailAddress is invalid </br>".PHP_EOL;
    }

    private function validateMailAddress()
    {
        return preg_match($this->reg_exp, $this->mailAddress);
    }

    private function checkMXRecord()
    {
        $arMailAddress = explode('@', $this->mailAddress);
        return getmxrr($arMailAddress[1], $hosts);
    }
}
