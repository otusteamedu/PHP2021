<?php

namespace App;

use CommonHelpers\ObjectResponse\Response;

class App
{
    private $response;

    public function __construct()
    {
        $this->response = Response::success();
    }

    /**
     * @param string[] $emailAddressList
     */
    public function run(array $emailAddressList)
    {
        $checkResult = EmailCheckerService::checkEmailList($emailAddressList);

        if ($checkResult === true) {
            $this->response
                ->setResult($checkResult)
                ->setMessage('All addresses is correct')
            ;
        } else {
            $this->response
                ->setResult(false)
                ->setMessage(sprintf('Address %s is incorrect', $checkResult))
            ;
        }

        return $this->response;
    }
}
