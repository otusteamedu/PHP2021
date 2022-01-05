<?php


namespace App;


interface ProductFactoryInterface
{
    public function createBurger() :ProductInteface;

    public function createSandwich() :ProductInteface;

    public function createHotDog() :ProductInteface;
}