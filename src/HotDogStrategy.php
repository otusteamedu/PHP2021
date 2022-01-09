<?php


namespace App;


class HotDogStrategy extends AbstractStrategy
{

    public function make($ingridients = [])
    {
        echo 'burger';
    }
}