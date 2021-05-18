<?php

namespace App\Http\Requests;

use App\Http\Requests\Contracts\FormRequestContract;
use App\Http\Validators\NotNullValidator;
use App\Http\Validators\OpenCloseBracketsValidator;

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

        if (!(new NotNullValidator($field))->validate()) {
            return false;
        }

        if (!(new OpenCloseBracketsValidator($field))->validate()) {
            return false;
        }

        return true;
    }
}