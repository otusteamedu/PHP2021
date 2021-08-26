<?php
namespace App;
use App\parser\sourceParserArr;
use App\validator\Validator;
use App\source\emailSource;

class App
{
    protected $source = null;
    protected $parser= null;
    protected $validator = null;

    function __construct()
    {
        $this->source      =  new  emailSource;
        $this->parser   =     new  sourceParserArr;
        $this->validator =    new  Validator;
    }

    public function run(){
        try {
            $emails = ['info@gismeteo.ru','info@rttv.ru'];

            $this->source->setResource($emails);

            $emailArray = $this->parser->parseEmailSource($this->source);

            $res_valid = $this->validator->checkEmail($emailArray);


        }catch (\Exception $e ){
            echo $e->getMessage();
        }

    }
}