<?php

namespace App\Http\Requests;

use App\Http\Requests\Contracts\FormRequestContract;
use App\Http\Validators\NotNullValidator;
use App\Http\Validators\OpenCloseBracketsValidator;
use App\Http\Exceptions\ValidationException;
use App\Http\Response\Response;

class FormRequest implements FormRequestContract
{
    private $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function rules()
    {
        $field = $this->request->post('string');
        $field = preg_replace("/[^()]/u","", $field);
        try {
            if (!(new NotNullValidator($field))->validate()) {
                throw new ValidationException();
            }

            if (!(new OpenCloseBracketsValidator($field))->validate()) {
                throw new ValidationException();
            }
        } catch (ValidationException $e) {
            (new Response())->setStatus(400);
        }
    }
}