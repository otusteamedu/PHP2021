<?php


namespace App;

interface ProductFactoryInterface
{
    public function createBurger() :BaseProduct;

    public function createSandwich() :BaseProduct;

    public function createHotDog() :BaseProduct;
}