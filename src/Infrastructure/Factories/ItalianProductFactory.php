<?php

namespace App\Infrastructure\Factories;

use App\Application\ProductFactoryInterface;
use App\Domain\Models\BaseProduct;
use App\Domain\Models\Burger;
use App\Domain\Models\HotDog;
use App\Domain\Models\Sandwich;

class ItalianProductFactory implements ProductFactoryInterface
{
    const BURGER_CUTLET = 'ItalianCutlet';
    const BURGER_BUN = 'ItalianBun';
    const BURGER_RECEIPT_FILLING = ['лук', 'перец'];

    const HOTDOG_SOUSAGE = 'ItalianSousage';
    const HOTDOG_BUN = 'ItalianBun';
    const HOTDOG_RECEIPT_FILLING = ['лук', 'перец'];

    const SANWICH_CHESSE = 'ItalianCheese';
    const SANWICH_BUN = 'ItalianBun';
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
        $this->baseHotDog->setReceiptFilling(self::HOTDOG_RECEIPT_FILLING);
        $this->baseHotDog->sausage = self::HOTDOG_SOUSAGE;
        $this->baseHotDog->bun = self::HOTDOG_BUN;

        $this->baseSandwich = new Sandwich();
        $this->baseSandwich->setReceiptFilling(self::SANWICH_RECEIPT_FILLING);
        $this->baseSandwich->cheese = self::SANWICH_CHESSE;
        $this->baseSandwich->bun = self::SANWICH_BUN;
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