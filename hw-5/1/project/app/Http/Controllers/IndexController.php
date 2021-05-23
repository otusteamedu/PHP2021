<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Http\Validators\EmailValidator;
use App\Http\Response\Response;
use App\Http\Exceptions\ValidationException;

class IndexController
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function index()
    {
        $email = $this->request->post('email');
        try {
            $validator = new EmailValidator($email);
            if (!$validator->validate()) {
                throw new ValidationException();
            }
        } catch (ValidationException $e) {
            (new Response())->setStatus(400);
        }
    }
}