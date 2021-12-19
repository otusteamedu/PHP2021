<?php

namespace App\Infrastructure\Controllers;


use App\Services\SendEmail;
use App\Services\SendEmailInterface;
use App\Services\ViewInterface;
use App\Services\ViewNative;
use App\Services\ViewTwig;

class BaseController
{

    /**
     * @var Auth
     */
    protected $auth;

    /**
     * @var ViewInterface
     */
    protected $view;

    /**
     * @var SendEmailInterface
     */
    protected $sendEmail;

    public function __construct()
    {
        $this->auth = new Auth();
        $this->sendEmail = new SendEmail();
        if (!empty(VIEW_TYPE) && VIEW_TYPE == 'twig') {
            $this->view = new ViewTwig();
        } else {
            $this->view = new ViewNative();
        }
    }

    protected function redirect($url)
    {
        //CONST base url
        header("Location: http://" . ADDRESS . $url); //
        exit();
    }

}

