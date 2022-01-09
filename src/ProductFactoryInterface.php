<?php


namespace App;


interface ProductFactoryInterface
{
    public function createBurger() :ProductPrototypeInterface;

    public function createSandwich() :ProductPrototypeInterface;

    public function createHotDog() :ProductPrototypeInterface;
}