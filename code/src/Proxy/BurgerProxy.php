<?php

namespace App\Proxy;

use App\AbstractFactory\Interface\Burger;

class BurgerProxy implements Burger
{

    private $burger;

    public function __construct(Burger $burger)
    {
        $this->burger = $burger;
    }

    public function StructureBurger(): string
    {
        if ($this->check()) {
            return $this->burger->StructureBurger();
        }
        
    }

    private function check(): bool
    {
        if($this->burger->cookingStage == 100) return 1; 

    }

}