<?php

namespace App\Application\Services;

interface AuthInterface
{
    public function login(array $user);

    public function logout();
}