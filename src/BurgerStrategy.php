<?php


namespace App;


class BurgerStrategy extends AbstractStrategy
{
    public function make(int $pepper, int $salt)
    {
        $burger = $this->factory->createBurger();
        $burger->pepper = $pepper;
        $burger->salt = $salt;
        return $burger;

    }
}