<?php

namespace App\Application\Services;

interface ViewMapperInterface
{
    public function __invoke() :ViewInterface;
}