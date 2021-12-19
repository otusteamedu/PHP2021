<?php

namespace App\Proxy;

use App\AbstractFactory\Interface\Sandwich;

class SandwichProxy implements Sandwich
{

    private $sandwich;

    public function __construct(Sandwich $sandwich)
    {
        $this->sandwich = $sandwich;
    }

    public function StructureSandwich(): string
    {
        if ($this->check()) {
            return $this->sandwich->StructureSandwich();
        }
        
    }

    private function check(): bool
    {
        if($this->sandwich->standard == 100) return 1; 

    }

}