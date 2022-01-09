<?php


namespace App;


interface ProductFactoryInterface
{
    public function createBurger() :Burger;

    public function createSandwich() :Sandwich;

    public function createHotDog() :HotDog;
}