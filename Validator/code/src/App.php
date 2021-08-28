<?php

namespace App;

use Validator\AnswerHttpJson;
use Validator\StringValidator;

class App
{
    private AnswerHttpJson $answer;

    private StringValidator $validator;

    public function run()
    {
        $this->answer = new AnswerHttpJson();
        $responseService = $this->answer->create();
        
        if (isset($_POST['string'])) {
            $this->validator = new StringValidator($_POST['string']);
           
            if ($this->validator->validate()) {
                $responseService->success();
            } else {
                $responseService->failed($this->validator->getError());
            }
        } else {
            $responseService->failed('Не передан POST-параметр string');
        }
    }
}