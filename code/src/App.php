<?php

namespace App;

use App\Http\Response;
use App\Validation\Validator;

class App
{
    private ?string $strParam = null;

    public function run() : void
    {
        try {
            $this->setParams();
            Validator::validate($this->strParam);
        } catch(\Exception $e) {
            Response::setResponse($e->getCode(), $e->getMessage());
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
            throw new \Exception('Empty or missing string parameter', Response::STATUS_UNSUPPORTED_TYPE);
        }
    }
}
