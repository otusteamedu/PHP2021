<?php


namespace App;


class BBQProductFactory implements ProductFactoryInterface
{
    private ProductPrototypeInterface $baseBurger;
    private ProductPrototypeInterface $baseSandwich;
    private ProductPrototypeInterface $baseHotDog;

    public function __construct()
    {
        $this->baseBurger = new Burger();
        $this->baseBurger->cutlet = 'BBQCutlet';
        $this->baseBurger->bun = 'BBQBun';
    }

    public function createBurger(): ProductPrototypeInterface
    {
        return $this->baseBurger->clone();
    }

    public function createSandwich(): ProductPrototypeInterface
    {
//        return new Sandwich();
    }

    public function createHotDog(): ProductPrototypeInterface
    {
//        return new HotDog();
    }
}