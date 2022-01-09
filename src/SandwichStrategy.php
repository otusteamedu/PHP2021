<?php


namespace App;


class SandwichStrategy extends AbstractStrategy
{

    public function make($ingridients = [])
    {
        echo 'burger';
    }
}