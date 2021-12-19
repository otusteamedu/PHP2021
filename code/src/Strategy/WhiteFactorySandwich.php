<?php

namespace App\Strategy;

use App\AbstractFactory\Factories\WhiteFactory;
use App\Proxy\SandwichProxy;
use App\Decorator\Ingredients\Sandwich\SalatSandwichDecorator;
use App\Decorator\Ingredients\Sandwich\TunatSandwichDecorator;
use App\Decorator\Ingredients\Sandwich\СheeseSandwichDecorator;
use App\Strategy\Interface\Strategy;

class WhiteFactorySandwich implements Strategy
{

    public function execute(int $standard): string
    {
        $whiteFactory = new WhiteFactory;
        $whiteSandwich = $whiteFactory->CreateSandwich($standard);

        $whiteSandwich = new SandwichProxy($whiteSandwich);

        $whiteSandwich = new SalatSandwichDecorator($whiteSandwich);
        $whiteSandwich = new TunatSandwichDecorator($whiteSandwich);
        $whiteSandwich = new СheeseSandwichDecorator($whiteSandwich);

        $whiteSandwich = $whiteSandwich->StructureSandwich();
        
        return $whiteSandwich;
        
    }

}