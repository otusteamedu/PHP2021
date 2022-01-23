<?php

namespace App\Service\AbstractFactory;

class Sandwich implements SandwichInterface
{

    public function getTopping(): string
    {
       return 'Sandwich ';
    }

    public function getTempirature()
    {
        return 'cold';
    }
}
