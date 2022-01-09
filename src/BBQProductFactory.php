<?php


namespace App;


class BBQProductFactory implements ProductFactoryInterface
{
    const BURGER_CUTLET = 'BBQCutlet';
    const BURGER_BUN = 'BBQBun';

    private Burger $baseBurger;
    private Sandwich $baseSandwich;
    private HotDog $baseHotDog;

    public function __construct()
    {
        $this->baseBurger = new Burger();
        $this->baseBurger->cutlet = self::BURGER_CUTLET;
        $this->baseBurger->bun = self::BURGER_BUN;
    }

    public function createBurger(): Burger
    {
        return $this->baseBurger->clone();
    }

    public function createSandwich(): Sandwich
    {
//        return new Sandwich();
    }

    public function createHotDog(): HotDog
    {
//        return new HotDog();
    }
}