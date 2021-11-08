<?php

namespace App\Service;

interface Service
{
    public const SOCKET_PATH = '/var/www/app/app.sock';
    public const EXIT = 'выход';

    public function run(): void;
}
