<?php 

namespace App;

class Application
{
    private $request;

    public function __construct()
    {
        if (!RequestValidator::checkRequestType('POST')) {
            throw new \Exception('Wrong request method');
        }
        if (RequestValidator::checkRequestIsEmpty($_POST)) {
            throw new \Exception('Empty request');
        }
        $this->request = $_POST;
    }

    public function run()
    {
        $mailValidator = new MailValidator();
        $result = '';
        foreach ($this->request['EMAIL_LIST'] as $mailAddress) {
            if($mailAddress == '')
                continue;
            if ($mailValidator->validate($mailAddress)) {
                $result .= "$mailAddress is valid and MX record found </br>".PHP_EOL;
                continue;
            }
            $result .="$mailAddress is invalid </br>".PHP_EOL;
        }
        if($result == '') {
            throw new \Exception('No data generated');
        }
        Response::generateOkResponse($result);
    }
}
