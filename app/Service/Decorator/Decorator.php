<?php

namespace App\Service\Decorator;

use App\Service\AbstractFactory\ToppingInterface;

class Decorator implements ToppingInterface
{
    protected $topping;

    public function __construct(ToppingInterface $topping)
    {
        $this->topping = $topping;
    }


    public function getTopping(): string
    {
        return $this->topping->getTopping();
    }
}
