<?php 

namespace App;

class Application
{
    private $request;

    public function __construct()
    {
        $this->request = $_POST;
        if ($this->checkRequestIsEmpty()) {
            throw new \Exception('No arguments passed');
        }
    }

    private function checkRequestIsEmpty()
    {
        if (!isset($this->request['EMAIL_LIST']) || empty($this->request['EMAIL_LIST'])) {
            return true;
        }
    }

    public function checkMailList()
    {
        $mailValidator = new MailValidator();
        $result = '';
        foreach ($this->request['EMAIL_LIST'] as $mailAddress) {
            if ($mailValidator->validate($mailAddress)) {
                $result .= "$mailAddress is valid and MX record found </br>".PHP_EOL;
                continue;
            }
            $result .="$mailAddress is invalid </br>".PHP_EOL;
        }
        return $result;
    }
}
