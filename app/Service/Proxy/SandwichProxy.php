<?php

namespace App\Service\Proxy;

use App\Service\AbstractFactory\SandwichInterface;

class SandwichProxy implements SandwichInterface
{
    private $sandwich;

    public function __construct(SandwichInterface $sandwich)
    {
        $this->sandwich = $sandwich;
    }

    public function getTempirature()
    {
        return ' hot';
    }
}
