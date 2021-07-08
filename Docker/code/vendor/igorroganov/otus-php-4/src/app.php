<?php
namespace App;

use App\validator\validator;
use App\http\httpRequest;
use App\http\handlerRequest;
use App\http\httpResponse;

class app
{
    protected $objRequest = null;
    protected $objValidate = null;
    protected $objHandler = null;

    function __construct()
    {
        $this->objRequest = new httpRequest();
        $this->objValidate = new Validator();
        $this->objHandler = new handlerRequest();
    }
	
    public function run(){
        try {
            $response = $this->objHandler->handle($this->objRequest);

            foreach ($response->getHeaders() as $name=>$value) {
                \header("$name:$value");
            }

            \http_response_code($response->getStatus());
            
        }catch (\Exception $e ){
            \header("403:bad request");
            \http_response_code(400);
        }
    }
}
