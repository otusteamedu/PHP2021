<?php


namespace App\Infrastructure\Factories;

use App\Domain\Models\BaseProduct;

interface ProductFactoryInterface
{
    public function createBurger() :BaseProduct;

    public function createSandwich() :BaseProduct;

    public function createHotDog() :BaseProduct;
}