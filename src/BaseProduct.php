<?php


namespace App;


class BaseProduct
{
    private $filling = [];

    public function __construct($filling = [])
    {
        $this->filling = $filling;
    }

    public function clone(): ProductPrototypeInterface
    {
        return new HotDog($this->filling);
    }
}