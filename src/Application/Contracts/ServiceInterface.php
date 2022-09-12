<?php

namespace App\Application\Contracts;

interface ServiceInterface
{
    public const CLIENT = 'client';
    public const SERVER = 'server';

    public function execute(): void;
}