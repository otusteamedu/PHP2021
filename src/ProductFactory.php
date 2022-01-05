<?php


namespace App;


class ProductFactory implements ProductFactoryInterface
{
    public function createBurger(): ProductInteface
    {
        return new Burger();
    }

    public function createSandwich(): ProductInteface
    {
        return new Sandwich();
    }

    public function createHotDog(): ProductInteface
    {
        $hotDog = new HotDog();
    }
}