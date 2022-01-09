<?php


namespace App;


class BurgerStrategy extends AbstractStrategy
{
    public function execute($ingridients = [])
    {
        $burger = $this->factory->createBurger();

    }
}