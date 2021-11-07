<?php

namespace App;

use App\Http\Response;
use App\Validation\Validator;

class App
{
    private ?string $strParam = null;

    public function run() : void
    {
        try{
            $this->setParams();
            if (Validator::checkBrackets($this->strParam)) {
                Response::setResponse(Response::STATUS_OK);
            } else {
                Response::setResponse(Response::STATUS_BAD_REQUEST);
            }
        } catch(\Exception $e) {
            Response::setResponse(Response::STATUS_UNSUPPORTED_TYPE, $e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    private function setParams() : void
    {
        $param = trim($_POST['string']);
        if (isset($param) && !empty($param)) {
            $this->strParam = $param;
        } else {
            throw new \Exception('Empty or missing string parameter');
        }
    }
}
