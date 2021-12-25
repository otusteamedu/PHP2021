<?php

namespace App\Application\Services;

abstract class BaseService
{
    protected $authService;
    protected $view;
    protected $sendEmail;

    public function __construct(AuthInterface $authService, ViewMapperInterface $view, SendEmail $sendEmail)
    {
        $this->authService = $authService;
        $this->view = $view();
        $this->sendEmail = $sendEmail;
    }


    protected function redirect($url)
    {
        //CONST base url
        header("Location: http://" . Config::getApp('ADDRESS') . $url); //
        return true;
    }
}