<?php


namespace App;


class BBQProductFactory implements ProductFactoryInterface
{
    const BURGER_CUTLET = 'BBQCutlet';
    const BURGER_BUN = 'BBQBun';

    private BaseProduct $baseBurger;
    private BaseProduct $baseSandwich;
    private BaseProduct $baseHotDog;

    public function __construct()
    {
        $this->baseBurger = new Burger();
        $this->baseBurger->cutlet = self::BURGER_CUTLET;
        $this->baseBurger->bun = self::BURGER_BUN;
    }

    public function createBurger(): BaseProduct
    {
        return $this->baseBurger->clone();
    }

    public function createSandwich(): BaseProduct
    {
//        return new Sandwich();
    }

    public function createHotDog(): BaseProduct
    {
//        return new HotDog();
    }
}