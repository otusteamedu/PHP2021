<?php

namespace App\Infrastructure\Controllers;


use App\Infrastructure\Models\Auth;
use App\Infrastructure\Models\View;
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

    public function __construct(Auth $auth, SendEmail $sendEmail, View $view)
    {
        $this->auth = $auth;
        $this->sendEmail = $sendEmail;
        $this->view = $view();
    }

    protected function redirect($url)
    {
        //CONST base url
        header("Location: http://" . ADDRESS . $url); //
        exit();
    }

}

