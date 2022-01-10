<?php

namespace App\Infrastructure\Factories;

use App\Application\ProductFactoryInterface;
use App\Domain\Models\BaseProduct;
use App\Domain\Models\Burger;
use App\Domain\Models\HotDog;
use App\Domain\Models\Sandwich;

class BBQProductFactory implements ProductFactoryInterface
{
    const BURGER_CUTLET = 'BBQCutlet';
    const BURGER_BUN = 'BBQBun';
    const BURGER_RECEIPT_FILLING = ['лук', 'перец'];

    const HOTDOG_SOUSAGE = 'BBQSousage';
    const HOTDOG_BUN = 'BBQBun';
    const HOTDOG_RECEIPT_FILLING = ['лук', 'перец'];

    const SANWICH_CHESSE = 'BBQCheese';
    const SANWICH_BUN = 'BBQBun';
    const SANWICH_RECEIPT_FILLING = ['лук', 'перец'];

    private BaseProduct $baseBurger;
    private BaseProduct $baseSandwich;
    private BaseProduct $baseHotDog;

    public function __construct()
    {
        $this->baseBurger = new Burger();
        $this->baseBurger->setReceiptFilling(self::BURGER_RECEIPT_FILLING);
        $this->baseBurger->cutlet = self::BURGER_CUTLET;
        $this->baseBurger->bun = self::BURGER_BUN;

        $this->baseHotDog = new HotDog();
        $this->baseBurger->setReceiptFilling(self::HOTDOG_RECEIPT_FILLING);
        $this->baseBurger->sausage = self::HOTDOG_SOUSAGE;
        $this->baseBurger->bun = self::HOTDOG_BUN;

        $this->baseHotDog = new Sandwich();
        $this->baseBurger->setReceiptFilling(self::SANWICH_RECEIPT_FILLING);
        $this->baseBurger->cheese = self::SANWICH_CHESSE;
        $this->baseBurger->bun = self::SANWICH_BUN;
    }

    public function createBurger(): BaseProduct
    {
        return $this->baseBurger->clone();
    }

    public function createSandwich(): BaseProduct
    {
        return $this->baseSandwich->clone();
    }

    public function createHotDog(): BaseProduct
    {
        return $this->baseHotDog->clone();
    }
}