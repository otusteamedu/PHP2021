<?php


namespace App;


class SandwichStrategy extends AbstractStrategy
{

    public function execute($ingridients = [])
    {
        echo 'burger';
    }
}