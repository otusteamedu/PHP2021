<?php

namespace App\Infrastructure\Controllers;

use App\Application\Services\Auth;
use GUMP;

class FrontController
{
    private $authService;

    public function __construct(Auth $authService)
    {
       $this->authService = $authService;
    }

    public function index()
    {
        return $this->authService->index();
    }

    public function register()
    {
        return $this->authService->register();
    }

    public function login()
    {
        return $this->authService->login();
    }

}