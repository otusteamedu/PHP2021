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
        $mailValidator->validateEmailList($this->request['EMAIL_LIST']);
    }
}
