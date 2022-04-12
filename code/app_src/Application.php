<?php

namespace App;

class Application
{
    private $request;

    public function __construct()
    {
        if (!RequestValidator::checkRequestType('POST')) {
            throw new \Exception('ERROR_REQUEST_METHOD');
        } elseif (RequestValidator::checkRequestIsEmpty($_POST)) {
            throw new \Exception('EMPTY_REQUEST');
        } else {
            $this->request = $_POST;
        }
    }

    public function run()
    {
        $mailValidator = new MailValidator();
        $mailValidator->validateEmails($this->request['EMAILS']);
    }
}
