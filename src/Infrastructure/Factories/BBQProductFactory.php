<?php

namespace App\Infrastructure\Factories;

use App\Application\ProductFactoryInterface;
use App\Domain\Models\BaseProduct;
use App\Domain\Models\BBQ\BBQBurger;
use App\Domain\Models\BBQ\BBQHotDog;
use App\Domain\Models\BBQ\BBQSandwich;

class BBQProductFactory implements ProductFactoryInterface
{
    private BaseProduct $baseBurger;
    private BaseProduct $baseSandwich;
    private BaseProduct $baseHotDog;

    public function __construct()
    {
        $this->baseBurger = new BBQBurger();
        $this->baseHotDog = new BBQHotDog();
        $this->baseSandwich = new BBQSandwich();
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