<?php

namespace App;

use VMeleshkin\Validators\EmailValidator;

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
        $mailValidator = new EmailValidator();
        $validationResult = $mailValidator->validateEmail($this->request['email']);

        if ($validationResult === 'EMAIL_OK') {
            Response::generateOkResponse($validationResult);
        } else {
            throw new \Exception($validationResult);
        }
    }
}
