<?php


namespace App;


class BurgerStrategy extends AbstractStrategy
{
    public function execute($ingridients = [])
    {
        $this->factory->createBurger();
    }
}