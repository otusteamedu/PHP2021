<?php
namespace App\http;
use App\validator\Validator;
use App\http\httpRequest;

class handlerRequest
{
    protected $validatorMethod = null;
    protected $request = null;

    function __construct()
    {
        $this->request = new httpRequest();
        $this->validatorMethod = new Validator($this->request->gettHttpBody);
    }

    public function handle(httpRequest $request){

        $brackets = $request->getHttpBody();

        if ( !$request->checkMethod() )
            return new httpResponse(400, ['message' => 'Not POST request']);

        if ( !$request->checkBrackets() ){
            return new httpResponse(400, ['message' => 'Empty string passed']);
        }

        if ( !$this->validatorMethod->IsValidBrackets($brackets) ){
            return new httpResponse(400, ['message' => 'Invalid brackets sequence']);
        }

        return new httpResponse(200, ['message' => 'OK']);
    }
}