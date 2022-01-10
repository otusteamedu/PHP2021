<?php


namespace App\Application\Strategies;



class SandwichStrategy extends AbstractStrategy
{

    public function make($ingridients = [])
    {
        echo 'burger';
    }
}