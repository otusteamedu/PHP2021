<?php


namespace App;


class BBQProductFactory implements ProductFactoryInterface
{
    const BURGER_CUTLET = 'BBQCutlet';
    const BURGER_BUN = 'BBQBun';

    private ProductPrototypeInterface $baseBurger;
    private ProductPrototypeInterface $baseSandwich;
    private ProductPrototypeInterface $baseHotDog;

    public function __construct()
    {
        $this->baseBurger = new Burger();
        $this->baseBurger->cutlet = self::BURGER_CUTLET;
        $this->baseBurger->bun = self::BURGER_BUN;
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