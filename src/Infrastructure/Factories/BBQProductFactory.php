<?php

namespace App\Infrastructure\Factories;

use App\Application\ProductFactoryInterface;
use App\Domain\Models\BaseProduct;
use App\Domain\Models\Burger;

class BBQProductFactory implements ProductFactoryInterface
{
    const BURGER_CUTLET = 'BBQCutlet';
    const BURGER_BUN = 'BBQBun';
    const BURGER_RECEIPT_FILLING = ['лук', 'перец'];

    private BaseProduct $baseBurger;
    private BaseProduct $baseSandwich;
    private BaseProduct $baseHotDog;

    public function __construct()
    {
        $this->baseBurger = new Burger();
        $this->baseBurger->setReceiptFilling(self::BURGER_RECEIPT_FILLING);
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