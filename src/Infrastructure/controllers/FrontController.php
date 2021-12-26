<?php

namespace App\Infrastructure\Controllers;

use App\Application\Services\Auth;
use GUMP;
use Symfony\Component\HttpFoundation\Request;

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

    public function register(Request $request)
    {
        return $this->authService->register($request);
    }

    public function login(Request $request)
    {
        return $this->authService->login($request);
    }

}