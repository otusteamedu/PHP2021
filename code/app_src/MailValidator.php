<?php 

namespace App;

class MailValidator
{
    private $reg_exp = '/^(([\wА-Яа-я]{1,})@([\wА-Яа-я]{1,}\.)+[A-Za-zА-Яа-я]{2,})$/ui';
    private $mailAddress;

    public function validate($mailAddress)
    {
        $this->mailAddress = $mailAddress;
        if($this->validateMailAddress()) {
            if ($this->checkMXRecord()) {
                return true;
            }
        }
        return false;
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
