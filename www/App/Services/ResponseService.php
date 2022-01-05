<?php

namespace App\Services;


class ResponseService
{
    public function setBadRequestHeader()
    {
        $this->setHeaderCode(400);

        throw new \RuntimeException('Bad Request :(', 400);
    }

    public function setSuccessHeader()
    {
        $this->setHeaderCode(200);

        echo 'well done! :)';

        return 1;
    }

    protected function setHeaderCode($code)
    {
        header('Content-Type: text/html; charset=utf-8', false, $code);
    }
}
